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
    public function getUserDescriptionAttr($value){
        $data['content']=cmf_replace_content_file_url(str_replace('<img','<img style="max-width:100%"',htmlspecialchars_decode($value)));
        $data['description']=mb_substr(strip_tags($data['content']),0,200);
        return $data;
    }
}