<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/2
 * Time: 下午4:13
 */

namespace api\xcx\model;


use think\Model;

class ResultPostModel extends Model
{
    protected $autoWriteTimestamp=true;
    protected $updateTime=false;

    public function setHuxingAttr($value){
        $arr=[
            ['1室', '2室', '3室', '4室', '5室'],
            ['1厅', '2厅', '3厅', '4厅', '5厅'],
            ['1卫', '2卫', '3卫', '4卫', '5卫'],
            ['1阳台', '2阳台', '3阳台', '4阳台', '5阳台'],
        ];
        $result='';
        if(is_array($value)){
            foreach ($value as $key=>$item){
                $result.=$arr[$key][$item];
            }
            return $result;
        }
    }
    public function addBaojia($data){
        $data['result_type']=1;
        $this->allowField(true)->isUpdate(false)->data($data,true)->save();
        return $this;
    }

}