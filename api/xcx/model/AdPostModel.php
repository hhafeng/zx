<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午10:33
 */

namespace api\xcx\model;


use think\Model;

class AdPostModel extends Model
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
        return $more;
    }
}