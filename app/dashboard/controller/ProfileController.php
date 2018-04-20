<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/20
 * Time: 上午10:42
 */

namespace app\dashboard\controller;


use app\dashboard\model\CustomerModel;
use cmf\controller\CustomerBaseController;

class ProfileController extends CustomerBaseController
{
    public function index(){

    }

    public function edit(){
        $customerModel=new CustomerModel();
        $profile=$customerModel->get(cmf_get_current_customer_id());
        //dump($profile->user_address['address'][0]['address']) ;die;
        $this->assign([
            'profile'=>$profile
        ]);
        return $this->fetch();
    }

    public function editPost(){
        if($this->request->isPost()){
            $data=$this->request->param();
            $post   = $data['post'];
            $result = $this->validate($post, 'EditCustomer');
            if ($result !== true) {
                $this->error($result);
            }

            $customerModel=new CustomerModel();

            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }

            if (!empty($post['address']) && !empty($post['lat']) && !empty($post['lng'])) {
                $data['post']['user_address']['address']=[];
                foreach ($post['address'] as $key=>$addr){
                    if(empty($addr) || empty($post['lat'][$key]) || empty($post['lng'][$key])){
                        $this->error('请填写地址并定位坐标');
                    }
                    array_push($data['post']['user_address']['address'],['address'=>$addr,'lat'=>$post['lat'][$key],'lng'=>$post['lng'][$key]]);
                }
            }

            $customerModel->editSave($data['post']);
            $this->success('保存成功!');
            //dump($data);die;


        }
    }

}