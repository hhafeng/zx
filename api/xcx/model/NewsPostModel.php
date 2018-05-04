<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午10:49
 */

namespace api\xcx\model;


use think\Model;

class NewsPostModel extends Model
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
    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function getContentAttr($value)
    {
        $data['content']=cmf_replace_content_file_url(str_replace('<img','<img style="max-width:100%"',htmlspecialchars_decode($value)));
        $data['description']=mb_substr(strip_tags($data['content']),0,30);
        return $data;
    }
    /*
     * 自动转换创建时间
     * */
    public function getCreateTimeAttr($value){
        $data['create_time']=date('Y年m月d日 H:i',$value);
        $data['smp_create_time']=date('Y-m-d',$value);
        return $data;
    }
}