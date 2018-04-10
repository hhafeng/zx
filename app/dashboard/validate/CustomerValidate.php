<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/10
 * Time: 上午11:23
 */

namespace app\dashboard\validate;


use think\Validate;

class CustomerValidate extends Validate
{
    protected $rule = [
        'user_logo|公司LOGO' => 'require',
        'user_nickname|公司名称' => 'require|length:3,20',
        'user_login|登陆用户名' => 'require|alphaNum|length:3,20|unique:customer',
        'mobile|登陆手机号' => 'require|regex:/^1\d{10}$/|unique:customer',
        'user_pass|登陆密码' => 'length:6,20',
        'user_telphone|联系电话' => 'require',
        'app_id|AppID' => 'require|unique:customer',
        'app_secret|AppSecret' => 'require',
        'expire_time|过期时间' => 'require|date',
    ];
    protected $message = [

    ];
}