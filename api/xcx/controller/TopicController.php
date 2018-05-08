<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/20
 * Time: 下午11:05
 */

namespace api\xcx\controller;


use api\xcx\model\ResultPostModel;
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
    public function save(){
        $data=$this->request->param();
        $result=$this->validate($data,'ResultPost');
        if($result!==true){
            $this->error($result);
        }
        if(!empty($token=$this->request->header('TOKEN'))){
            $user=cmf_get_user_by_token($token);
        }
        if(!empty($user)){
            $data['user_id']=$user['user_id'];
        }
        if(!empty($object_id=$this->request->param('object_id'))){
            $data['object_id']=$object_id;
        }else{
            $data['object_id']=0;
        }
        $data['customer_id']=$this->userId;
        $data['result_type']=$this->request->param('result_type');

        $resultPostModel=new ResultPostModel();
        $findResult=$resultPostModel->where([
            'customer_id'=>$this->userId,
            'object_id'=>$data['object_id'],
            'result_type'=>$data['result_type'],
            'telphone'=>$data['telphone'],
        ])->find();
        if($findResult){
            $this->error('您已经提交过了');
        }


        $resultPostModel->allowField(true)->isUpdate(false)->data($data,true)->save();

        $this->success('恭喜您,报名成功');
    }

}