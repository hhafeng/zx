<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/16
 * Time: 下午4:25
 */

namespace app\dashboard\model;


use think\Model;

class DesignerPostModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    protected $autoWriteTimestamp=true;
    protected function base($query){
        $query->where(['delete_time'=>0,'customer_id'=>cmf_get_current_customer_id()]);
    }

    public function addDesigner($data){
        $data['customer_id'] = cmf_get_current_customer_id();
        $data['clicks']=mt_rand(60,180);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(false)->save();
        return $this;
    }

    public function editDesigner($data){
        unset($data['customer_id']);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(true)->save();
        return $this;
    }

}