<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/5/11
 * Time: 下午5:09
 */

namespace app\dashboard\controller;


use app\dashboard\model\ResultPostModel;
use cmf\controller\CustomerBaseController;

class ResultController extends CustomerBaseController
{
    public function index(){
        $where=[];
        if(!empty($this->request->param('id'))){
            $where=array_merge(['object_id'=>$this->request->param('id')]);
        }
        $resultPostModel=new ResultPostModel();
        $result=$resultPostModel->where($where)->order('create_time desc')->paginate(10);
        $this->assign([
            'result'=>$result,
            'page'=>$result->render()
        ]);
        return $this->fetch();
    }
    //标记为已经处理
    public function deal($id=0){
        if($this->request->isAjax()){
            $resultPostModel=new ResultPostModel();
            $result=$resultPostModel->save(['deal'=>1],['id'=>$id,'customer_id'=>cmf_get_current_customer_id()]);
            if($result){
                $this->success('操作成功');
            }else{
                $this->error('出错了,请重试');
            }
        }
    }
}