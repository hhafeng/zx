<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/17
 * Time: 上午10:02
 */

namespace app\dashboard\validate;


use think\Validate;

class NewsPostValidate extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require|length:3,60',
        'thumbnail|缩略图' => 'require',
        'content|文章内容' => 'require',
        'sort_id|排序ID' => 'number',
    ];
}