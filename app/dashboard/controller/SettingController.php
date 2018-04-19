<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/19
 * Time: 下午2:10
 */

namespace app\dashboard\controller;


use app\dashboard\model\CustomerNavModel;
use app\dashboard\model\CustomerSettingModel;
use app\dashboard\model\DefaultSettingModel;
use cmf\controller\CustomerBaseController;

class SettingController extends CustomerBaseController
{

    //工具设置
    public function tools(){
        $customerSettingModel=new CustomerSettingModel();
        $calcSetting=$customerSettingModel->get(['setting_name'=>'calc']);
        $zeroSetting=$customerSettingModel->get(['setting_name'=>'zero']);
        if($calcSetting && $zeroSetting){
            $this->assign([
                'calc'=>$calcSetting->setting_value,
                'zero'=>$zeroSetting->setting_value
            ]);
        }else{
            $defaultSettingModel=new DefaultSettingModel();
            $calcSetting=$defaultSettingModel->get(['setting_name'=>'calc']);
            $zeroSetting=$defaultSettingModel->get(['setting_name'=>'zero']);
            $this->assign([
                'calc'=>$calcSetting->setting_value,
                'zero'=>$zeroSetting->setting_value
            ]);
        }
        return $this->fetch();
    }
    //工具设置保存
    public function savePost(){
        $data=$this->request->param();
        $customerSettingModel=new CustomerSettingModel();
        $post['calc_title']=$data['calc']['title'];
        $post['calc_btn_title']=$data['calc']['btn_title'];
        $post['calc_btn_color']=$data['calc']['btn_color'];
        $post['calc_top_photo']=$data['calc']['top_photo'];
        $post['calc_bottom_photos']=!empty($data['calc']['bottom_photos']) ? $data['calc']['bottom_photos'] : '';
        $post['rengong']=$data['calc']['rengong'];
        $post['cailiao']=$data['calc']['cailiao'];
        $post['sheji']=$data['calc']['sheji'];
        $post['zhijian']=$data['calc']['zhijian'];
        $post['zero_title']=$data['zero']['title'];
        $post['zero_btn_title']=$data['zero']['btn_title'];
        $post['zero_btn_color']=$data['zero']['btn_color'];
        $post['zero_top_photo']=$data['zero']['top_photo'];
        $post['zero_bottom_photos']=!empty($data['zero']['bottom_photos']) ? $data['zero']['bottom_photos'] : '';
        $result = $this->validate($post, 'CustomerSetting');
        if ($result !== true) {
            $this->error($result);
        }
        foreach ($data as $key=>$item){
            $postData['customer_id']=cmf_get_current_customer_id();
            $postData['setting_name']=$key;
            $postData['setting_value']=$item;
            $result=$customerSettingModel->where('setting_name',$key)->find();
            if($result){
                $customerSettingModel->save(['setting_value'=>$postData['setting_value']],['setting_name'=>$postData['setting_name']]);
            }else{
                $customerSettingModel->isUpdate(false)->data($postData,true)->save();
            }
        }
        $this->success('保存成功');
    }
    //导航设置
    public function nav(){
        $navModel=new CustomerNavModel();
        $navs=$navModel->order('sort_id desc,id desc')->select();
        $this->assign('navs',$navs);
        return $this->fetch();
    }
    //添加导航
    public function addNav(){
        return $this->fetch();
    }
    public function addNavPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'CustomerNav');
            if ($result !== true) {
                $this->error($result);
            }
            $navModel=new CustomerNavModel();

            $navModel->addNav($data['post']);

            $this->success('添加成功!', url('dashboard/Setting/nav'));
        }
    }
    //编辑导航
    public function editNav($id=0){
        $navModel=new CustomerNavModel();
        $nav=$navModel->get($id);
        $this->assign('nav',$nav);
        return $this->fetch();
    }
    public function editNavPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'CustomerNav');
            if ($result !== true) {
                $this->error($result);
            }
            $navModel=new CustomerNavModel();

            $navModel->editNav($data['post']);

            $this->success('保存成功!', url('dashboard/Setting/nav'));
        }
    }
    //删除导航
    public function deleteNav($id=0){
        if($this->request->isAjax()) {
            $navModel=new CustomerNavModel();
            $result = $navModel->save(['delete_time' => time()], ['id' => $id, 'customer_id' => cmf_get_current_customer_id()]);
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败,请重试');
            }
        }
    }

}