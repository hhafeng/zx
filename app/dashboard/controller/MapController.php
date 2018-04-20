<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/20
 * Time: 上午11:42
 */

namespace app\dashboard\controller;


use cmf\controller\CustomerBaseController;

class MapController extends CustomerBaseController
{

    public function index(){
        return $this->fetch();
    }

}