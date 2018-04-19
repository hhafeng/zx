<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 下午2:22
 */

namespace api\xcx\controller;


use api\xcx\model\DesignerPostModel;
use cmf\controller\RestCustomerBaseController;

class DesignerController extends RestCustomerBaseController
{
    protected $designModel;

    public function __construct(DesignerPostModel $designModel)
    {
        parent::__construct();
        $this->designModel=$designModel;
    }

    public function index(){
        $page=$this->request->param('page');
        $where=[
            'customer_id'=>$this->userId,
        ];
        $data=$this->designModel->order('sort_id desc,id desc')->where($where)->page($page,15)->select();
        $this->success($data);
    }
    public function read($id){
        $data=$this->designModel->get($id);
        if($data){
            $this->designModel->where('id',$id)->setInc('clicks');
            $this->success($data);
        }else{
            $this->error('请求内容不存在');
        }
    }
}