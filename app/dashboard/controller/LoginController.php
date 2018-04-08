<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/8
 * Time: 下午5:51
 */

namespace app\dashboard\controller;


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
        if (cmf_is_user_login()) { //已经登录时直接跳到首页
            return redirect($this->request->root() . '/');
        } else {
            return $this->fetch(":login");
        }
    }
}