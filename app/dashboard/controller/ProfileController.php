<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/20
 * Time: 上午10:42
 */

namespace app\dashboard\controller;


use cmf\controller\CustomerBaseController;

class ProfileController extends CustomerBaseController
{
    public function index(){

    }

    public function edit(){
        return $this->fetch();
    }

    public function editPost(){
        if($this->request->isPost()){





        }
    }

}