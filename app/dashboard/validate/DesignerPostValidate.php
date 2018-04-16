<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/16
 * Time: 下午4:25
 */

namespace app\dashboard\validate;


use think\Validate;

class DesignerPostValidate extends Validate
{
    protected $rule = [
        'thumbnail|设计师头像' => 'require',
        'title|设计师名称' => 'require|length:3,20',
        'sub_title|设计师头衔' => 'require|length:3,10',
        'design_style|设计风格' => 'require|length:3,20',
        'design_idea|设计理念' => 'require|length:5,100',
        'description|个人介绍' => 'require|length:10,300',
    ];
}