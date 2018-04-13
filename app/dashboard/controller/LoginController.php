<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/8
 * Time: 下午5:51
 */

namespace app\dashboard\controller;

use app\dashboard\model\CustomerModel;
use think\Validate;
use cmf\controller\HomeBaseController;

class LoginController extends HomeBaseController
{
    public function index(){
        $redirect = $this->request->post("redirect");
        if (empty($redirect)) {
            $redirect = $this->request->server('HTTP_REFERER');
        } else {
            $redirect = base64_decode($redirect);
        }
        session('login_http_referer', $redirect);
        if (cmf_is_customer_login()) { //已经登录时直接跳到首页
            return redirect($this->request->root() . '/');
        } else {
            return $this->fetch(":login");
        }
    }

    public function doLogin(){
        if ($this->request->isPost()) {
            $validate = new Validate([
                'captcha'  => 'require',
                'username' => 'require',
                'password' => 'require|min:6|max:32',
            ]);
            $validate->message([
                'username.require' => '用户名不能为空',
                'password.require' => '密码不能为空',
                'password.max'     => '密码不能超过32个字符',
                'password.min'     => '密码不能小于6个字符',
                'captcha.require'  => '验证码不能为空',
            ]);

            $data = $this->request->post();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            if (!cmf_captcha_check($data['captcha'])) {
                $this->error(lang('CAPTCHA_NOT_RIGHT'));
            }

            $customerModel         = new CustomerModel();
            $user['user_pass'] = $data['password'];
            if (preg_match('/(^(13\d|15[^4\D]|16\d|17[013678]|18\d|19\d)\d{8})$/', $data['username'])) {
                $user['mobile'] = $data['username'];
                $log            = $customerModel->doMobile($user);
            } else {
                $user['user_login'] = $data['username'];
                $log                = $customerModel->doName($user);
            }
            $session_login_http_referer = session('login_http_referer');
            $redirect                   = empty($session_login_http_referer) ? $this->request->root() : $session_login_http_referer;
            switch ($log) {
                case 0:
                    $this->success(lang('LOGIN_SUCCESS'), $redirect);
                    break;
                case 1:
                    $this->error(lang('PASSWORD_NOT_RIGHT'));
                    break;
                case 2:
                    $this->error('账户不存在');
                    break;
                case 3:
                    $this->error('账号被禁止访问系统');
                    break;
                case 4:
                    $this->error('账号已经过期');
                    break;
                default :
                    $this->error('未受理的请求');
            }
        } else {
            $this->error("请求错误");
        }
    }

}