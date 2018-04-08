<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/2
 * Time: 下午2:28
 */

namespace app\dashboard\controller;


use cmf\controller\UserBaseController;

class CaseController extends UserBaseController
{
    public function index(){
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }
    public function addPost(){

    }
    public function edit(){

    }
    public function editPost(){

    }
    public function delete(){

    }
}