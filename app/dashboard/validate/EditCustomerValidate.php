<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/20
 * Time: 下午4:45
 */

namespace app\dashboard\validate;


use think\Validate;

class EditCustomerValidate extends Validate
{
    protected $rule = [
        'user_logo|公司LOGO' => 'require',
        'user_nickname|公司名称' => 'require|length:3,20',
        'user_telphone|联系电话' => 'require|min:7|max:15',
    ];
}