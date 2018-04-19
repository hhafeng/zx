<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 下午3:07
 */

namespace api\xcx\model;


use think\Model;

class CaseCategoryModel extends Model
{
    protected function base($query){
        $query->where(['delete_time'=>0]);
    }
}