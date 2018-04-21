<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/21
 * Time: 下午5:57
 */

namespace api\xcx\validate;


use think\Validate;

class BaojiaValidate extends Validate
{
    protected $rule=[
        'area|面积'=>'require|number|gt:1',
        'telphone'=>'require|/^1[3-9][0-9]\d{8}$/',
    ];
    protected $message=[
        'area'=>'面积必须是大于1的数字',
        'telphone'=>'手机号格式不正确'
    ];
}