<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/7
 * Time: 下午5:11
 */

namespace api\xcx\controller;


use cmf\controller\RestCustomerBaseController;
use think\Db;

class FavoriteController extends RestCustomerBaseController
{
    public function save($id=0){
        $token=$this->request->header('TOKEN');
        $user=cmf_get_user_by_token($token);
        if(empty($token) || empty($user)){
            $this->error('收藏失败');
        }
        $findFavorite=Db::name('user_favorite')->where('object_id',$id)->find();
        if($findFavorite){
            $this->error('已经收藏过了');
        }
        Db::name('user_favorite')->insert([
            'user_id'=>$user['id'],
            'customer_id'=>$this->userId,
            'table_name'=>'case_post',
            'object_id'=>$id,
            'create_time'=>time()
        ]);
        $this->success('收藏成功');
    }
}