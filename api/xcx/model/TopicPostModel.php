<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:06
 */

namespace api\xcx\model;


use think\Model;

class TopicPostModel extends Model
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
    /*
     * 自动转换开始时间
     * */
    public function getStartTimeAttr($value){
        return date('Y.m.d H:i',$value);
    }
    /*
     * 自动转换结束时间
     * */
    public function getEndTimeAttr($value){
        return date('Y.m.d H:i',$value);
    }
    /*
     * 活动状态
     * status等于1,活动进行中;等于0或者已经到达结束时间,活动结束
     * */
    public function getStatusAttr($value,$data){
        if($data['end_time']<time()){
            return 0;
        }else{
            return $value;
        }
    }
}