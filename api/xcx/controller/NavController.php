<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:12
 */

namespace api\xcx\controller;


use api\xcx\model\CustomerNavModel;
use cmf\controller\RestCustomerBaseController;

class NavController extends RestCustomerBaseController
{
    public function index(){
        $where=[
            'customer_id'=>$this->userId
        ];
        $navModel=new CustomerNavModel();
        $data=$navModel->where($where)->order('sort_id desc,id desc')->select();
        $this->success($data);
    }
}