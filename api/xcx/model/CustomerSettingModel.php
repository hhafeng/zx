<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:36
 */

namespace api\xcx\model;


use think\Model;

class CustomerSettingModel extends Model
{
    protected $type=[
        'setting_value'=>'array'
    ];
    public function getSettingValueAttr($value){
        $setting_value=json_decode($value,true);
        if (!empty($setting_value['top_photo'])) {
            $imgUrl=$setting_value['top_photo'];
            $setting_value['top_photo'] = cmf_get_image_url($imgUrl);
        }

        if (!empty($setting_value['bottom_photos'])) {
            foreach ($setting_value['bottom_photos'] as $key => $value) {
                $setting_value['bottom_photos'][$key] = cmf_get_image_url($value);
            }
        }
        return $setting_value;
    }
}