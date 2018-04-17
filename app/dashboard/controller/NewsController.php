<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/17
 * Time: 上午9:58
 */

namespace app\dashboard\controller;


use app\dashboard\model\NewsPostModel;
use cmf\controller\CustomerBaseController;

class NewsController extends CustomerBaseController
{
    public function index(){
        $newsPostModel=new NewsPostModel();
        $where=[];
        $news=$newsPostModel->where($where)->order('sort_id desc,id desc')->paginate(10);
        $this->assign([
            'news'=>$news,
            'page'=>$news->render()
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
            $result = $this->validate($post, 'NewsPost');
            if ($result !== true) {
                $this->error($result);
            }
            $newsPostModel=new NewsPostModel();
            $newsPostModel->addNews($data['post']);
            $this->success('添加成功!', url('dashboard/News/index'));
        }
    }
    public function edit($id=0){
        $newsPostModel=new NewsPostModel();
        $news=$newsPostModel->get($id);
        $this->assign('news',$news);
        return $this->fetch();
    }
    public function editPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'NewsPost');
            if ($result !== true) {
                $this->error($result);
            }
            $newsPostModel=new NewsPostModel();
            if(!$newsPostModel->get($post['id'])){
                $this->error('参数出错');
            }
            $newsPostModel->editNews($data['post']);
            $this->success('保存成功!', url('dashboard/News/index'));
        }
    }
    public function delete($id=0){
        if($this->request->isAjax()) {
            $newsPostModel=new NewsPostModel();
            $result = $newsPostModel->save(['delete_time' => time()], ['id' => $id, 'customer_id' => cmf_get_current_customer_id()]);
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败,请重试');
            }
        }
    }
}