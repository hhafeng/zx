<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/16
 * Time: 下午4:25
 */

namespace app\dashboard\controller;


use cmf\controller\CustomerBaseController;

class DesignerController extends CustomerBaseController
{
    public function index(){
        $this->assign('designers',[]);
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }
    public function addPost(){

    }
    public function edit(){
        return $this->fetch();
    }
    public function editPost(){

    }
    public function delete(){

    }
}