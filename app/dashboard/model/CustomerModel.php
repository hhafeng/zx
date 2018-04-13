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

    public function doMobile($user){
        $result = $this->where('mobile', $user['mobile'])->find();
        if (!empty($result)) {
            $comparePasswordResult = cmf_compare_password($user['user_pass'], $result['user_pass']);
            if ($comparePasswordResult) {
                //拉黑判断。
                if ($result['user_status'] == 0) {
                    return 3;
                }
                if($result['expire_time']<time()){
                    return 4;
                }
                session('customer', $result->toArray());
                $data = [
                    'last_login_time' => time(),
                    'last_login_ip'   => get_client_ip(0, true),
                ];
                $this->where('id', $result["id"])->update($data);
                return 0;
            }
            return 1;
        }
        return 2;
    }

    public function doName($user){
        $result = $this->where('user_login', $user['user_login'])->find();
        if (!empty($result)) {
            $comparePasswordResult = cmf_compare_password($user['user_pass'], $result['user_pass']);
            if ($comparePasswordResult) {
                //拉黑判断。
                if ($result['user_status'] == 0) {
                    return 3;
                }
                if($result['expire_time']<time()){
                    return 4;
                }
                session('customer', $result->toArray());
                $data = [
                    'last_login_time' => time(),
                    'last_login_ip'   => get_client_ip(0, true),
                ];
                $this->where('id', $result["id"])->update($data);
                return 0;
            }
            return 1;
        }
        return 2;
    }

}