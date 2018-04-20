<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:38
 */

namespace api\xcx\controller;


use api\xcx\model\CustomerSettingModel;
use api\xcx\model\DefaultSettingModel;
use cmf\controller\RestCustomerBaseController;

class ToolController extends RestCustomerBaseController
{
    public function index(){
        $customerSettingModel=new CustomerSettingModel();
        $defaultSettingModel=new DefaultSettingModel();
        $result=$customerSettingModel->get(['customer_id'=>$this->userId]);
        if($result){
            $data['calc']=$customerSettingModel->get(['setting_name'=>'calc','customer_id'=>$this->userId])->setting_value;
            $data['zero']=$customerSettingModel->get(['setting_name'=>'zero','customer_id'=>$this->userId])->setting_value;
        }else{
            $data['calc']=$defaultSettingModel->get(['setting_name'=>'calc'])->setting_value;
            $data['zero']=$defaultSettingModel->get(['setting_name'=>'zero'])->setting_value;
        }
        $this->success($data);
    }
}