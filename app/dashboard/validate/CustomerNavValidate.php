<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/19
 * Time: 下午5:11
 */

namespace app\dashboard\validate;


use think\Validate;

class CustomerNavValidate extends Validate
{
    protected $rule = [
        'thumbnail|导航图标' => 'require',
        'title|导航名称' => 'require|length:2,4',
        'link_url|链接地址' => 'require',
        'sort_id|排序ID' => 'number',
    ];
}