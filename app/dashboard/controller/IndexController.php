<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/13
 * Time: 下午5:19
 */

namespace app\dashboard\controller;


use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    /**
     * 前台客户户首页(公开)
     */
    public function index()
    {

        return $this->fetch();
    }

    /**
     * 前台ajax 判断用户登录状态接口
     */
    function isLogin()
    {
        if (cmf_is_customer_login()) {
            $this->success("用户已登录",null,['user'=>cmf_get_current_customer()]);
        } else {
            $this->error("此用户未登录!");
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session("customer", null);//只有前台客户退出
        return redirect($this->request->root() . "/");
    }
}