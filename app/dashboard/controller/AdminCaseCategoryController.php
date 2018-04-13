<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/13
 * Time: 上午11:28
 */

namespace app\dashboard\controller;


use app\dashboard\model\CaseCategoryModel;
use cmf\controller\AdminBaseController;

class AdminCaseCategoryController extends AdminBaseController
{
    /**
     * 案例分类
     * @adminMenu(
     *     'name'   => '案例分类',
     *     'parent' => 'dashboard/AdminZx/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '案例分类',
     *     'param'  => ''
     * )
     */
    public function index(){
        $caseCategoryModel=new CaseCategoryModel();
        $parentCate=$caseCategoryModel->where(['pid'=>0])->order('sort_id desc,id asc')->select();
        $this->assign('parentCate',$parentCate);
        return $this->fetch();
    }

    /**
     * 添加案例分类
     * @adminMenu(
     *     'name'   => '添加案例分类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加案例分类',
     *     'param'  => ''
     * )
     */
    public function add(){

    }

    /**
     * 添加案例分类提交
     * @adminMenu(
     *     'name'   => '添加案例分类提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加案例分类提交',
     *     'param'  => ''
     * )
     */
    public function addPost(){

    }

    /**
     * 修改案例分类
     * @adminMenu(
     *     'name'   => '修改案例分类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改案例分类',
     *     'param'  => ''
     * )
     */
    public function edit(){

    }

    /**
     * 修改案例分类提交
     * @adminMenu(
     *     'name'   => '修改案例分类提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改案例分类提交',
     *     'param'  => ''
     * )
     */
    public function editPost(){

    }

    /**
     * 删除案例分类
     * @adminMenu(
     *     'name'   => '删除案例分类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除案例分类',
     *     'param'  => ''
     * )
     */
    public function delete(){

    }

}