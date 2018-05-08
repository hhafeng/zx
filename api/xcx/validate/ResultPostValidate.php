<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/8
 * Time: 下午3:02
 */

namespace api\xcx\validate;


use think\Validate;

class ResultPostValidate extends Validate
{
    protected $rule=[
        'name|姓名'=>'require|max:10',
        'telphone'=>'require|regex:/^1[3-9][0-9]\d{8}$/',
    ];
    protected $message=[
        'area.require'=>'姓名是必填项',
        'area'=>'姓名最多10个字',
        'telphone.require'=>'手机号必填',
        'telphone.regex'=>'手机号格式不正确'
    ];
}