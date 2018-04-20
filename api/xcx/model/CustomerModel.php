<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:18
 */

namespace api\xcx\model;


use think\Model;

class CustomerModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    /**
     * more 自动转化
     * @param $value
     * @return array
     */
    public function getMoreAttr($value)
    {
        $more = json_decode($value, true);

        if (!empty($more['photos'])) {
            foreach ($more['photos'] as $key => $value) {
                $more['photos'][$key]['url'] = cmf_get_image_url($value['url']);
            }
        }
        return $more;
    }
    public function getUserLogoAttr($value){
        if (!empty($value)) {
            return cmf_get_image_url($value,'thumbnail300x300');
        }
    }
    public function getUserAddressAttr($value){
        return json_decode($value,true);
    }
}