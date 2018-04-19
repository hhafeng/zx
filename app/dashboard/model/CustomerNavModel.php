<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/19
 * Time: 下午5:10
 */

namespace app\dashboard\model;


use think\Model;

class CustomerNavModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    protected function base($query){
        $query->where(['delete_time' =>0,'customer_id'=>cmf_get_current_customer_id()]);
    }

    public function addNav($data){
        $data['customer_id'] = cmf_get_current_customer_id();
        $data['link_value']=$data['link_url'];
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(false)->save();
        return $this;
    }

    public function editNav($data){
        unset($data['customer_id']);
        $data['link_value']=$data['link_url'];
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(true)->save();
        return $this;
    }

    public function setLinkUrlAttr($value){
        $resUrl='';
        $linkArr=explode(',',$value);
        $sysPagesModel=new SysPagesModel();
        $sysPage=$sysPagesModel->get($linkArr[0]);
        if($sysPage){
            $resUrl=$sysPage['url'];
        }
        if($sysPage && !empty($linkArr[1])){
            $resUrl.='?='.$linkArr[1];
        }
        return $resUrl;
    }

}