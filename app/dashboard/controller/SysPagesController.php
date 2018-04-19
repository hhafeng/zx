<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/19
 * Time: 下午3:40
 */

namespace app\dashboard\controller;


use app\dashboard\model\SysPagesModel;
use cmf\controller\CustomerBaseController;

class SysPagesController extends CustomerBaseController
{
    public function index(){
        $ids                 = $this->request->param('ids');
        $selectedIds         = explode(',', $ids);
        $pagesModel=new SysPagesModel();
        $pages=$pagesModel->all();
        $this->assign([
            'pages'=>$pages,
            'selectedIds'=>$selectedIds,
        ]);
        return $this->fetch();
    }

    public function select($id=0){
        $pagesModel=new SysPagesModel();
        $page=$pagesModel->get($id);
        $data=[];
        if($page && !empty($page['module'])){
            $data=model($page['module'])->order('id desc')->paginate(10);
        }
        $this->assign([
            'data'=>$data,
            'page'=>$data->render()
        ]);
        return $this->fetch();
    }
}