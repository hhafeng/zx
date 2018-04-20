<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:05
 */

namespace api\xcx\controller;


use api\xcx\model\TopicPostModel;
use cmf\controller\RestCustomerBaseController;

class TopicController extends RestCustomerBaseController
{
    public function index(){
        $page=$this->request->param('page');
        $where=[
            'customer_id'=>$this->userId
        ];
        $topicModel=new TopicPostModel();
        $data=$topicModel->where($where)->order('id desc')->page($page,10)->select();
        $this->success($data);
    }
    public function read($id){
        $topicModel=new TopicPostModel();
        $data=$topicModel->get($id);
        if($data){
            $topicModel->where('id',$id)->setInc('clicks');
            $this->success($data);
        }else{
            $this->error('内容不存在');
        }
    }

}