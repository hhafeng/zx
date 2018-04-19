<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/19
 * Time: 下午2:23
 */

namespace app\dashboard\model;


use think\Model;

class CustomerSettingModel extends Model
{
    protected $type=[
        'setting_value'=>'array'
    ];
    public function base($query){
        $query->where(['customer_id'=>cmf_get_current_customer_id()]);
    }

}