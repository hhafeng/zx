<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/4
 * Time: 下午3:02
 */

namespace api\xcx\controller;


use cmf\controller\RestCustomerBaseController;
use EasyWeChat\Factory;
use think\Db;

class LoginController extends RestCustomerBaseController
{
    public function save(){
        $config = [
            'app_id' => $this->user['app_id'],
            'secret' => $this->user['app_secret'],
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
            /*
            'log' => [
                'level' => 'debug',
                'file' => __DIR__.'/wechat.log',
            ],*/
        ];

        $app = Factory::miniProgram($config);
        $response=$app->auth->session($this->request->param('code'));
        $openid     = $response['openid'];
        $sessionKey = $response['session_key'];
        $wxUserData['sessionKey'] = $sessionKey;

        $findThirdPartyUser = Db::name("third_party_user")
            ->where('openid', $openid)
            ->find();
        if ($findThirdPartyUser) {
            $userId = $findThirdPartyUser['user_id'];
            $token  = cmf_generate_user_token($findThirdPartyUser['user_id'], 'wxapp');

            $userData = [
                'last_login_ip'   => $this->request->ip(),
                'last_login_time' => time(),
                'login_times'     => ['exp', 'login_times+1'],
                'more'            => json_encode($wxUserData)
            ];
            Db::name("third_party_user")
                ->where('openid', $openid)
                ->update($userData);
        }else{
            //TODO 使用事务做用户注册
            $userId = Db::name("user")->insertGetId([
                'create_time'     => time(),
                'user_status'     => 1,
                'user_type'       => 2,
                'last_login_ip'   => $this->request->ip(),
                'last_login_time' => time(),
            ]);

            Db::name("third_party_user")->insert([
                'openid'          => $openid,
                'user_id'         => $userId,
                'third_party'     => 'wxapp',
                'app_id'          => $this->user['app_id'],
                'last_login_ip'   => $this->request->ip(),
                'last_login_time' => time(),
                'create_time'     => time(),
                'login_times'     => 1,
                'status'          => 1,
                'more'            => json_encode($wxUserData)
            ]);
            $token = cmf_generate_user_token($userId, 'wxapp');
        }
        $user = Db::name('user')->where('id', $userId)->find();

        $this->success("登录成功!", ['token' => $token, 'user' => $user]);
    }
}