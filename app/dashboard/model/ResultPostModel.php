<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/11
 * Time: 下午4:16
 */

namespace app\dashboard\model;


use think\Model;

class ResultPostModel extends Model
{
    public function base($query){
        $query->where('customer_id',cmf_get_current_customer_id());
    }
    public function getCreateTimeAttr($value){
        return date('Y-m-d H:i',$value);
    }
}