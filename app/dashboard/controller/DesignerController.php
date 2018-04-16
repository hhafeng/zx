<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/16
 * Time: 下午4:25
 */

namespace app\dashboard\controller;


use app\dashboard\model\DesignerPostModel;
use cmf\controller\CustomerBaseController;

class DesignerController extends CustomerBaseController
{
    public function index(){
        $designerModel=new DesignerPostModel();
        $where=[];
        $designers=$designerModel->where($where)->order('sort_id desc,id desc')->paginate(10);
        $this->assign([
            'designers'=>$designers,
            'page'=>$designers->render()
        ]);
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }
    public function addPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'DesignerPost');
            if ($result !== true) {
                $this->error($result);
            }
            $designerModel=new DesignerPostModel();
            $designerModel->addDesigner($data['post']);
            $this->success('添加成功!', url('dashboard/Designer/index'));
        }
    }
    public function edit($id=0){
        $designerModel=new DesignerPostModel();
        $designer=$designerModel->get($id);
        $this->assign('designer',$designer);
        return $this->fetch();
    }
    public function editPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'DesignerPost');
            if ($result !== true) {
                $this->error($result);
            }
            $designerModel=new DesignerPostModel();
            if(!$designerModel->get($post['id'])){
                $this->error('参数出错');
            }
            $designerModel->editDesigner($data['post']);
            $this->success('保存成功!', url('dashboard/Designer/index'));
        }
    }
    public function delete($id=0){
        if($this->request->isAjax()) {
            $designerModel=new DesignerPostModel();
            $result = $designerModel->save(['delete_time' => time()], ['id' => $id, 'customer_id' => cmf_get_current_customer_id()]);
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败,请重试');
            }
        }
    }
    public function select(){
        $ids                 = $this->request->param('ids');
        $selectedIds         = explode(',', $ids);
        $designerModel=new DesignerPostModel();
        $where=[];
        $desinger=$designerModel->where($where)->order('id desc')->paginate(10);
        $this->assign([
            'desinger'=>$desinger,
            'page'=>$desinger->render(),
            'selectedIds'=>$selectedIds,
        ]);
        return $this->fetch();
    }
}