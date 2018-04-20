<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/20
 * Time: 上午10:05
 */

namespace app\dashboard\validate;


use think\Validate;

class AdPostValidate extends Validate
{
    protected $rule = [
        'thumbnail|广告图片' => 'require',
        'title|广告名称' => 'require|length:2,20',
        'link_url|链接地址' => 'require',
        'sort_id|排序ID' => 'number',
    ];
}