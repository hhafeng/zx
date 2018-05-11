<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/17
 * Time: 下午4:41
 */

namespace app\dashboard\model;


use think\Model;

class TopicPostModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    protected $autoWriteTimestamp=true;
    protected $updateTime=false;
    protected function base($query){
        $query->where('delete_time',0)->where('customer_id',cmf_get_current_customer_id());
    }

    public function addTopic($data){
        $data['customer_id'] = cmf_get_current_customer_id();
        $data['clicks']=mt_rand(60,180);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(false)->save();
        return $this;
    }

    public function editTopic($data){
        unset($data['customer_id']);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(true)->save();
        return $this;
    }
    public function setStartTimeAttr($value){
        return strtotime($value);
    }
    public function setEndTimeAttr($value){
        return strtotime($value);
    }
    public function resultpost(){
        return $this->hasMany('ResultPostModel','object_id','id');
    }
}