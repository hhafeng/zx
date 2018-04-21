<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 上午9:58
 */

namespace api\xcx\controller;


use api\xcx\model\CasePostModel;
use cmf\controller\RestCustomerBaseController;

class CaseController extends RestCustomerBaseController
{
    protected $caseModel;

    public function __construct(CasePostModel $caseModel)
    {
        parent::__construct();
        $this->caseModel=$caseModel;
    }

    public function index(){
        $page=$this->request->param('page');
        $where=[
            'customer_id'=>$this->userId,
        ];
        !empty($this->request->param('isIndex')) ? $where=array_merge(['is_index'=>1],$where) : false;
        !empty($this->request->param('styleId')) ? $where=array_merge(['style_id'=>$this->request->param('styleId')],$where) : false;
        !empty($this->request->param('huxingId')) ? $where=array_merge(['huxing_id'=>$this->request->param('huxingId')],$where) : false;
        !empty($this->request->param('classId')) ? $where=array_merge(['class_id'=>$this->request->param('classId')],$where) : false;
        $data=$this->caseModel->where($where)->order('sort_id desc,id desc')->page($page,10)->select();
        $this->success($data);
    }

    public function read($id){
        $data=$this->caseModel->get($id);
        if($data){
            $this->caseModel->where('id',$id)->setInc('clicks');
            $this->success($data);
        }else{
            $this->error('请求内容不存在');
        }

    }


}