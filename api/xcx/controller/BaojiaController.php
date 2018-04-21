<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/21
 * Time: 下午5:11
 */

namespace api\xcx\controller;


use cmf\controller\RestCustomerBaseController;

class BaojiaController extends RestCustomerBaseController
{
    public function index(){

    }
    public function save(){
        $data=$this->request->param();
        $result=$this->validate($data,'Baojia');
        if($result!==true){
            $this->error($result);
        }
        $this->success($data);
    }
}