<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/10
 * Time: 下午4:30
 */

namespace app\dashboard\controller;


use cmf\controller\AdminBaseController;
use think\Db;

class AdminIconController extends AdminBaseController
{
    /**
     * 图标管理
     * @adminMenu(
     *     'name'   => '图标管理',
     *     'parent' => 'dashboard/AdminZx/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '图标管理',
     *     'param'  => ''
     * )
     */
    public function index(){
        $icons=Db::name('sys_icon')->order('id desc')->paginate(30);
        $this->assign([
            'icons'=>$icons,
            'page'=>$icons->render()
        ]);
        return $this->fetch();
    }
    /**
     * 添加图标
     * @adminMenu(
     *     'name'   => '添加图标',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加图标',
     *     'param'  => ''
     * )
     */
    public function add(){
        return $this->fetch();
    }

    /**
     * 添加图标提交
     * @adminMenu(
     *     'name'   => '添加图标提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加图标提交',
     *     'param'  => ''
     * )
     */
    public function addPost(){
        $data=$this->request->param();
        if(empty($data['photo_urls'])){
            $this->error('请先上传图标');
        }
        $post=[];
        foreach ($data['photo_urls'] as $photo_url){
            array_push($post,['icon_url'=>$photo_url]);
        }
        $result=Db::name('sys_icon')->insertAll($post);
        if($result){
            $this->success('添加成功',url('AdminIcon/index'));
        }else{
            $this->error('出错了,请重试');
        }
    }

    /**
     * 删除图标
     * @adminMenu(
     *     'name'   => '删除图标',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除图标',
     *     'param'  => ''
     * )
     */
    public function delete($id){
        $result=Db::name('sys_icon')->delete($id);
        $result ? $this->success('删除成功') : $this->error('出错了,请重试');
    }




}