<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/10
 * Time: 下午4:23
 */

namespace app\dashboard\controller;


use app\dashboard\model\DefaultSettingModel;
use cmf\controller\AdminBaseController;

class AdminDefaultSettingController extends AdminBaseController
{
    /**
     * 默认设置
     * @adminMenu(
     *     'name'   => '默认设置',
     *     'parent' => 'dashboard/AdminZx/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '默认设置',
     *     'param'  => ''
     * )
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * 保存默认设置
     * @adminMenu(
     *     'name'   => '保存默认设置',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '保存默认设置',
     *     'param'  => ''
     * )
     */
    public function savePost(){
        $data=$this->request->param();
        $defaultSettingModel=new DefaultSettingModel();
        foreach ($data as $key=>$item){
            $post['setting_name']=$key;
            $post['setting_value']=json_encode($item);
            $result=$defaultSettingModel->where('setting_name',$key)->find();
            if($result){
                $defaultSettingModel->save(['setting_value'=>$post['setting_value']],['setting_name'=>$post['setting_name']]);
            }else{
                $defaultSettingModel->isUpdate(false)->data($post,true)->save();
            }
        }
        $this->success('保存成功');
    }
}