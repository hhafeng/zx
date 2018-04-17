<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/17
 * Time: 下午4:40
 */

namespace app\dashboard\controller;


use app\dashboard\model\TopicPostModel;
use cmf\controller\CustomerBaseController;

class TopicController extends CustomerBaseController
{
    public function index(){
        $topicPostModel=new TopicPostModel();
        $where=[];
        $topic=$topicPostModel->where($where)->order('id desc')->paginate(10);
        $this->assign([
            'topic'=>$topic,
            'page'=>$topic->render()
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
            $post['photo_urls']=empty($data['photo_urls']) ? '' : $data['photo_urls'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'TopicPost');
            if ($result !== true) {
                $this->error($result);
            }
            $topicPostModel=new TopicPostModel();

            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }
            $topicPostModel->addTopic($data['post']);
            $this->success('添加成功!', url('dashboard/Topic/index'));
        }
    }
    public function edit($id=0){
        $topicPostModel=new TopicPostModel();
        $topic=$topicPostModel->get($id);
        $this->assign('topic',$topic);
        return $this->fetch();
    }
    public function editPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['photo_urls']=empty($data['photo_urls']) ? '' : $data['photo_urls'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'TopicPost');
            if ($result !== true) {
                $this->error($result);
            }
            $topicPostModel=new TopicPostModel();
            if(!$topicPostModel->get($post['id'])){
                $this->error('参数出错');
            }
            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }
            $topicPostModel->editTopic($data['post']);
            $this->success('保存成功!', url('dashboard/Topic/index'));
        }
    }
    public function delete($id=0){
        if($this->request->isAjax()) {
            $topicPostModel=new TopicPostModel();
            $result = $topicPostModel->save(['delete_time' => time()], ['id' => $id, 'customer_id' => cmf_get_current_customer_id()]);
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败,请重试');
            }
        }
    }
}