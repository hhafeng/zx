<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/13
 * Time: 下午5:19
 */

namespace app\dashboard\controller;


use app\dashboard\model\CasePostModel;
use app\dashboard\model\ResultPostModel;
use app\dashboard\model\TopicPostModel;
use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    /**
     * 前台客户户首页(公开)
     */
    public function index()
    {
        $caseModel=new CasePostModel();
        $topicModel=new TopicPostModel();
        $resultModel=new ResultPostModel();
        $data['caseCount']=$caseModel->count();
        $data['topicCount']=$topicModel->count();
        $data['resultCount']=$resultModel->count();
        $data['undealResultCount']=$resultModel->where('deal',0)->count();
        $this->assign('data',$data);
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