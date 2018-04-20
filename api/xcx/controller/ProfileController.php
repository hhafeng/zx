<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:18
 */

namespace api\xcx\controller;


use api\xcx\model\CustomerModel;
use cmf\controller\RestCustomerBaseController;

class ProfileController extends RestCustomerBaseController
{
    public function index(){
        $customerModel=new CustomerModel();
        $data=$customerModel->get(function($query){
            $query->where('id',$this->userId)->field('mobile,user_login,user_logo,user_nickname,user_telphone,user_address,user_description,more');
        });
        $this->success($data);
    }
}