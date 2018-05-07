<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 上午10:01
 */

namespace api\xcx\model;


use think\Db;
use think\Model;

class CasePostModel extends Model
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
    public function getClicksAttr($value,$data){
        $res['clicks']=$value;
        $res['favorites']=Db::name('user_favorite')->where('object_id',$data['id'])->count();
        return $res;
    }
}