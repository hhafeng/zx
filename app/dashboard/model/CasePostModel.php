<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/14
 * Time: 上午10:43
 */

namespace app\dashboard\model;


use think\Model;

class CasePostModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    protected $autoWriteTimestamp=true;


    protected function base($query){
        $query->where(['delete_time'=>0,'customer_id'=>cmf_get_current_customer_id()]);
    }

    public function addCase($data){
        $data['customer_id'] = cmf_get_current_customer_id();
        $data['clicks']=mt_rand(60,180);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(false)->save();
        return $this;
    }

    public function editCase($data){
        unset($data['customer_id']);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(true)->save();
        return $this;
    }

    public function styleName(){
        return $this->hasOne('CaseCategoryModel','id','style_id');
    }

    public function huxingName(){
        return $this->hasOne('CaseCategoryModel','id','huxing_id');
    }

    public function className(){
        return $this->hasOne('CaseCategoryModel','id','class_id');
    }


}