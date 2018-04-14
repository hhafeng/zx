<?php
/**
 * Created by PhpStorm.
 * User: zhanyingfeng
 * Date: 2018/4/13
 * Time: 下午9:05
 */

namespace app\dashboard\controller;


use app\dashboard\model\CaseCategoryModel;
use cmf\controller\CustomerBaseController;
use think\Validate;

class CaseCategoryController extends CustomerBaseController
{
    public function index(){
        $caseCategoryModel=new CaseCategoryModel();
        $parentCate=$caseCategoryModel->where(['pid'=>0])->order('sort_id desc,id asc')->select();
        $where=['customer_id'=>cmf_get_current_customer_id(),'delete_time'=>0];
        !empty($this->request->param('id')) ? $where=array_merge(['pid'=>$this->request->param('id')],$where) : $where;
        $cate=$caseCategoryModel->order('sort_id desc,id desc')->where($where)->paginate(15);
        $this->assign([
            'parentCate' => $parentCate,
            'cate' => $cate,
            'page' => $cate->render()
        ]);
        return $this->fetch();
    }

    public function add(){
        $caseCategoryModel=new CaseCategoryModel();
        $parentCate=$caseCategoryModel->where(['pid'=>0])->order('sort_id desc,id asc')->select();
        $this->assign('parentCate',$parentCate);
        return $this->fetch();
    }

    public function addPost(){
        $validate = new Validate([
            'pid|所属类别'  => 'require|number',
            'name|分类名称' => 'require|min:2|max:8',
            'sort_id|排序ID' => 'number',
        ]);
        $data=$this->request->param();
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $data['customer_id']=cmf_get_current_customer_id();
        $caseCategoryModel=new CaseCategoryModel();
        $caseCategoryModel->allowField(true)->isUpdate(false)->data($data)->save();
        $this->success('添加成功');


    }

    public function edit($id){
        $caseCategoryModel=new CaseCategoryModel();
        $parentCate=$caseCategoryModel->where(['pid'=>0])->order('sort_id desc,id asc')->select();
        $cate=$caseCategoryModel->get(['id'=>$id,'customer_id'=>cmf_get_current_customer_id()]);
        $this->assign([
            'parentCate'=>$parentCate,
            'cate' =>$cate
        ]);
        return $this->fetch();

    }

    public function editPost(){
        $validate = new Validate([
            'pid|所属类别'  => 'require|number',
            'name|分类名称' => 'require|min:2|max:8',
            'sort_id|排序ID' => 'number',
        ]);
        $data=$this->request->param();
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $caseCategoryModel=new CaseCategoryModel();
        $result=$caseCategoryModel->allowField(true)->save($data,['id'=>$data['id'],'customer_id'=>cmf_get_current_customer_id()]);
        if($result!==false){
            $this->success('保存成功');
        }else{
            $this->error('保存失败,请重试');
        }

    }

    public function delete($id=0){
        $caseCategoryModel=new CaseCategoryModel();
        $result=$caseCategoryModel->save(['delete_time'=>time()],['id'=>$id,'customer_id'=>cmf_get_current_customer_id()]);
        if($result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败,请重试');
        }

    }
}