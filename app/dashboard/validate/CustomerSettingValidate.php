<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/19
 * Time: 下午2:56
 */

namespace app\dashboard\validate;


use think\Validate;

class CustomerSettingValidate extends Validate
{
    protected $rule = [
        'calc_title|装修计算器标题' => 'require|length:5,15',
        'calc_btn_title|装修计算器按钮文字' => 'require|length:2,8',
        'calc_btn_color|装修计算器按钮颜色' => 'require|/^#[0-9a-fA-F]{6}$/',
        'calc_top_photo|装修计算器顶部图片' => 'require',
        'calc_bottom_photos|装修计算器下部图片' => 'require',
        'rengong|半包人工费' => 'require|number',
        'cailiao|半包材料费' => 'require|number',
        'sheji|半包设计费' => 'require|number',
        'zhijian|半包质检费' => 'require|number',
        'zero_title|免费设计工具标题' => 'require|length:5,15',
        'zero_btn_title|免费设计工具按钮文字' => 'require|length:2,8',
        'zero_btn_color|免费设计工具按钮颜色' => 'require|/^#[0-9a-fA-F]{6}$/',
        'zero_top_photo|免费设计工具顶部图片' => 'require',
        'zero_bottom_photos|免费设计工具下部图片' => 'require',
    ];
}