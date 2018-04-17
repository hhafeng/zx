<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/17
 * Time: 上午10:00
 */

namespace app\dashboard\model;


use think\Model;

class NewsPostModel extends Model
{
    protected $type=[
        'more' => 'array'
    ];
    protected $autoWriteTimestamp=true;
    protected function base($query){
        $query->where(['delete_time'=>0,'customer_id'=>cmf_get_current_customer_id()]);
    }
    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function getContentAttr($value)
    {
        return cmf_replace_content_file_url(htmlspecialchars_decode($value));
    }

    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function setContentAttr($value)
    {
        return htmlspecialchars(cmf_replace_content_file_url(htmlspecialchars_decode($value), true));
    }
    public function addNews($data){
        $data['customer_id'] = cmf_get_current_customer_id();
        $data['clicks']=mt_rand(60,180);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(false)->save();
        return $this;
    }

    public function editNews($data){
        unset($data['customer_id']);
        if (!empty($data['more']['thumbnail'])) {
            $data['more']['thumbnail'] = cmf_asset_relative_url($data['more']['thumbnail']);
        }
        $this->allowField(true)->data($data, true)->isUpdate(true)->save();
        return $this;
    }
}