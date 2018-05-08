<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/8
 * Time: 上午11:46
 */

namespace api\xcx\model;


use think\Model;

class UserFavoriteModel extends Model
{
    public function cases(){
        return $this->hasOne('CasePostModel','id','object_id');
    }
}