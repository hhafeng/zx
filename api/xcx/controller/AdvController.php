<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午10:33
 */

namespace api\xcx\controller;


use api\xcx\model\AdPostModel;
use cmf\controller\RestCustomerBaseController;

class AdvController extends RestCustomerBaseController
{
    public function index(){
        $pid=$this->request->param('pid');
        $advModel=new AdPostModel();
        $advs=$advModel->where(['pid'=>$pid,'customer_id'=>$this->userId])->order('sort_id desc,id asc')->select();
        $this->success($advs);
    }
    public function update($id){
        $advModel=new AdPostModel();
        $advModel->where('id',$id)->setInc('clicks');
        $this->success('更新成功');
    }
}