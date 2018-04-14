<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/2
 * Time: 下午2:28
 */

namespace app\dashboard\controller;


use app\dashboard\model\CaseCategoryModel;
use app\dashboard\model\CasePostModel;
use cmf\controller\CustomerBaseController;

class CaseController extends CustomerBaseController
{
    public function index(){
        $caseModel=new CasePostModel();
        $where=[];
        $case=$caseModel->where($where)->order('id desc')->paginate(10);
        $this->assign([
            'case'=>$case,
            'page'=>$case->render()
        ]);
        return $this->fetch();
    }
    public function add(){
        $caseCateModel=new CaseCategoryModel();
        $styleCate=$caseCateModel->all(['pid'=>1,'customer_id'=>cmf_get_current_customer_id()]);
        $huxingCate=$caseCateModel->all(['pid'=>2,'customer_id'=>cmf_get_current_customer_id()]);
        $classCate=$caseCateModel->all(['pid'=>3,'customer_id'=>cmf_get_current_customer_id()]);
        $this->assign([
            'styleCate'=>$styleCate,
            'huxingCate'=>$huxingCate,
            'classCate'=>$classCate
        ]);
        return $this->fetch();
    }
    public function addPost(){
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];
            $post['photo_urls']=empty($data['photo_urls']) ? '' : $data['photo_urls'];
            $post['thumbnail']=$post['more']['thumbnail'];
            $result = $this->validate($post, 'CasePost');
            if ($result !== true) {
                $this->error($result);
            }

            $caseModel=new CasePostModel();

            if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                $data['post']['more']['photos'] = [];
                foreach ($data['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                }
            }
            $caseModel->addCase($data['post']);

            $this->success('添加成功!', url('Case/index'));
        }
    }
    public function edit(){

    }
    public function editPost(){

    }
    public function delete(){

    }
}