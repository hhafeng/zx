<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/11
 * Time: 下午5:09
 */

namespace app\dashboard\controller;


use app\dashboard\model\ResultPostModel;
use cmf\controller\CustomerBaseController;

class ResultController extends CustomerBaseController
{
    public function index(){
        $where=[];
        if(!empty($this->request->param('id'))){
            $where=array_merge(['object_id'=>$this->request->param('id')]);
        }
        $resultPostModel=new ResultPostModel();
        $result=$resultPostModel->where($where)->order('create_time desc')->select();
        $this->assign('result',$result);
        return $this->fetch();
    }
}