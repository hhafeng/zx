<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/10
 * Time: 下午4:30
 */

namespace app\dashboard\controller;


use cmf\controller\AdminBaseController;

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
    public function delete(){

    }




}