<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 下午2:45
 */

namespace api\xcx\model;


use think\Model;

class DesignerPostModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    protected function base($query){
        $query->where(['delete_time'=>0]);
    }

    /**
     * more 自动转化
     * @param $value
     * @return array
     */
    public function getMoreAttr($value)
    {
        $more = json_decode($value, true);
        if (!empty($more['thumbnail'])) {
            $imgUrl=$more['thumbnail'];
            $more['thumbnail'] = cmf_get_image_url($imgUrl);
            $more['thumbnail300'] = cmf_get_image_url($imgUrl,'thumbnail300x300');
        }

        if (!empty($more['photos'])) {
            foreach ($more['photos'] as $key => $value) {
                $more['photos'][$key]['url'] = cmf_get_image_url($value['url']);
            }
        }
        return $more;
    }
}