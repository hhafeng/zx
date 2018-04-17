<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/17
 * Time: 下午4:48
 */

namespace app\dashboard\validate;


use think\Validate;

class TopicPostValidate extends Validate
{
    protected $rule = [
        'title|活动标题' => 'require|length:3,20',
        'thumbnail|顶部图片' => 'require',
        'photo_urls|底部图片' => 'require',
        'start_time|开始时间' => 'require|date',
        'end_time|结束时间' => 'require|date',
    ];
}