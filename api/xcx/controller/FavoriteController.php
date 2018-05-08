<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/7
 * Time: 下午5:11
 */

namespace api\xcx\controller;


use api\xcx\model\UserFavoriteModel;
use cmf\controller\RestCustomerBaseController;
use think\Db;

class FavoriteController extends RestCustomerBaseController
{
    public function index(){
        $page=$this->request->param('page');
        $token=$this->request->header('TOKEN');
        $user=cmf_get_user_by_token($token);
        if(empty($token) || empty($user)){
            $this->error('未登陆');
        }
        $favoriteModel=new UserFavoriteModel();
        /*$favorite=Db::name('user_favorite')->alias('f')
            ->join('__CASE_POST__ c','f.object_id=c.id')
            ->where('f.user_id',$user['id'])
            ->field('f.object_id,c.*')
            ->order('f.create_time desc')
            ->page($page,10)->select();*/
        $favorite=$favoriteModel->with('cases')->order('create_time desc')->page($page,10)->select();
        $this->success($favorite);

    }
    public function save($id=0,$action='addFavorite'){
        $token=$this->request->header('TOKEN');
        $user=cmf_get_user_by_token($token);
        if(empty($token) || empty($user)){
            $this->error('收藏失败');
        }
        $findFavorite=Db::name('user_favorite')->where('user_id',$user['id'])->where('object_id',$id)->find();
        if($findFavorite){
            Db::name('case_post')->where('id',$id)->setDec('favorites');
            Db::name('user_favorite')->where('user_id',$user['id'])->where('object_id',$id)->delete();
            $this->success('取消收藏');
        }else{
            Db::name('case_post')->where('id',$id)->setInc('favorites');
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
}