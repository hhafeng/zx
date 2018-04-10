<?php
namespace app\dashboard\model;
use think\Model;

/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/10
 * Time: 上午9:59
 */
class CustomerModel extends Model
{
    protected $type = [
        'more' => 'array',
    ];
    protected $autoWriteTimestamp = true;
    protected $updateTime=false;

    public function AdminAddCustomer($data){
        $data['user_pass']=cmf_password($data['user_pass']);
        if (!empty($data['user_logo'])) {
            $data['user_logo'] = cmf_asset_relative_url($data['user_logo']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(false)->save();
        return $this;
    }
    public function AdminEditCustomer($data){
        if(empty($data['user_pass'])){
            unset($data['user_pass']);
        }else{
            $data['user_pass']=cmf_password($data['user_pass']);
        }
        if (!empty($data['user_logo'])) {
            $data['user_logo'] = cmf_asset_relative_url($data['user_logo']);
        }
        $this->allowField(true)->isUpdate(true)->data($data, true)->save();
        return $this;
    }
    public function setExpireTimeAttr($value){
        return strtotime($value);
    }

}