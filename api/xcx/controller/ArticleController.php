<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午10:48
 */

namespace api\xcx\controller;


use api\xcx\model\NewsPostModel;
use cmf\controller\RestCustomerBaseController;

class ArticleController extends RestCustomerBaseController
{
    public function index(){
        $page=$this->request->param('page');
        $articleModel=new NewsPostModel();
        $where=[
            'customer_id'=>$this->userId,
        ];
        $data=$articleModel->where($where)->order('sort_id desc,id desc')->page($page,10)->select();
        $this->success($data);
    }
    public function read($id){
        $articleModel=new NewsPostModel();
        $data=$articleModel->get($id);
        if($data){
            $articleModel->where('id',$id)->setInc('clicks');
            $data['author']=$this->user['user_nickname'];
            $this->success($data);
        }else{
            $this->error('文章不存在');
        }
    }
}