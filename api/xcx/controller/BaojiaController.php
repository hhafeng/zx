<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/21
 * Time: 下午5:11
 */

namespace api\xcx\controller;


use api\xcx\model\ResultPostModel;
use cmf\controller\RestCustomerBaseController;
use api\xcx\model\CustomerSettingModel;
use api\xcx\model\DefaultSettingModel;

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
        if(!empty($token=$this->request->header('TOKEN'))){
            $user=cmf_get_user_by_token($token);
        }
        if(!empty($user)){
            $data['user_id']=$user['user_id'];
        }
        $data['customer_id']=$this->userId;
        $resultPostModel=new ResultPostModel();
        $resultPostModel->addBaojia($data);

        $customerSettingModel=new CustomerSettingModel();
        $defaultSettingModel=new DefaultSettingModel();
        $result=$customerSettingModel->get(['customer_id'=>$this->userId]);
        if($result){
            $calc=$customerSettingModel->get(['setting_name'=>'calc','customer_id'=>$this->userId])->setting_value;
        }else{
            $calc=$defaultSettingModel->get(['setting_name'=>'calc'])->setting_value;
        }
        $resultData=[];
        $resultData['cailiaofei']=$calc['cailiao']*$data['area'];
        $resultData['rengongfei']=$calc['rengong']*$data['area'];
        $resultData['shejifei']=$calc['sheji']*$data['area'];
        $resultData['zhijianfei']=$calc['zhijian']*$data['area'];
        $resultData['total']=$resultData['cailiaofei']+$resultData['rengongfei']+$resultData['shejifei']+$resultData['zhijianfei'];

        $this->success('计算成功',$resultData);
    }
}