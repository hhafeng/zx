<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/14
 * Time: 上午10:56
 */

namespace app\dashboard\validate;


use think\Validate;

class CasePostValidate extends Validate
{
    protected $rule = [
        'title|案例标题' => 'require|length:3,20',
        'style_id|风格' => 'require|number',
        'huxing_id|户型' => 'require|number',
        'class_id|类别' => 'require|number',
        'thumbnail|缩略图' => 'require',
        'photo_urls|案例相册' => 'require',
    ];
}