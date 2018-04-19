<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 下午3:06
 */

namespace api\xcx\controller;


use api\xcx\model\CaseCategoryModel;
use cmf\controller\RestCustomerBaseController;

class CaseCategoryController extends RestCustomerBaseController
{
    protected $caseCategoryModel;

    public function __construct(CaseCategoryModel $caseCategoryModel)
    {
        parent::__construct();
        $this->caseCategoryModel=$caseCategoryModel;
    }

    public function index(){
        $where=[
            'customer_id'=>$this->userId,
        ];
        $data['styleList']=$this->caseCategoryModel->where($where)->where('pid',1)->order('sort_id desc,id desc')->select()->toArray();
        array_unshift($data['styleList'],['id'=>0,'name'=>'不限']);
        $data['huxingList']=$this->caseCategoryModel->where($where)->where('pid',2)->order('sort_id desc,id desc')->select()->toArray();
        array_unshift($data['huxingList'],['id'=>0,'name'=>'不限']);
        $data['classList']=$this->caseCategoryModel->where($where)->where('pid',3)->order('sort_id desc,id desc')->select()->toArray();
        array_unshift($data['classList'],['id'=>0,'name'=>'不限']);
        $this->success($data);
    }

    public function read($id){
        $data=$this->caseCategoryModel->get($id);
        if($data){
            $this->success($data);
        }else{
            $this->error('请求内容不存在');
        }
    }
}