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

class LoginController extends RestCustomerBaseController
{
    public function save(){
        $config = [
            'app_id' => $this->user['app_id'],
            'secret' => $this->user['app_secret'],

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
/*
            'log' => [
                'level' => 'debug',
                'file' => __DIR__.'/wechat.log',
            ],*/
        ];

        $app = Factory::miniProgram($config);
        $result=$app->auth->session($this->request->param('code'));
        $this->success($result);
    }
}