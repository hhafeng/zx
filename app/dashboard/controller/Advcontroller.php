<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/20
 * Time: 上午10:03
 */

namespace app\dashboard\controller;


use app\dashboard\model\AdPostModel;
use cmf\controller\CustomerBaseController;
use think\Db;

class Advcontroller extends CustomerBaseController
{
    public function index(){
        $advModel=new AdPostModel();
        $advs=$advModel->order('sort_id desc,id desc')->select();
        $this->assign('advs',$advs);
        return $this->fetch();
    }
    public function add(){
        $adPosition=Db::name('ad_position')->select();
        $this->assign('adPosition',$adPosition);
        return $this->fetch();
    }
    public function addPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'AdPost');
            if ($result !== true) {
                $this->error($result);
            }
            $advModel=new AdPostModel();

            $advModel->addAdv($data['post']);

            $this->success('添加成功!', url('dashboard/Adv/index'));
        }
    }
    public function edit($id=0){
        $adPosition=Db::name('ad_position')->select();
        $advModel=new AdPostModel();
        $adv=$advModel->get($id);
        $this->assign([
            'adPosition'=>$adPosition,
            'adv'=>$adv
        ]);
        return $this->fetch();
    }
    public function editPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'AdPost');
            if ($result !== true) {
                $this->error($result);
            }
            $advModel=new AdPostModel();
            if(!$advModel->get($post['id'])){
                $this->error('参数出错');
            }
            $advModel->editAdv($data['post']);

            $this->success('保存成功!', url('dashboard/Adv/index'));
        }
    }
    public function delete($id=0){
        if($this->request->isAjax()) {
            $advModel=new AdPostModel();
            $result = $advModel->save(['delete_time' => time()], ['id' => $id, 'customer_id' => cmf_get_current_customer_id()]);
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败,请重试');
            }
        }
    }
}