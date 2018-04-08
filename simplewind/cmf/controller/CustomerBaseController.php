<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/8
 * Time: 下午5:47
 */

namespace cmf\controller;


class CustomerBaseController extends HomeBaseController
{
    public function _initialize()
    {
        parent::_initialize();
        $this->checkCustomerLogin();
    }
}