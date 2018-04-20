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
        $params=$this->request->param();
        if(empty($params['lat'])){
            $params['lat']=29.720259;
        }
        if(empty($params['lng'])){
            $params['lng']=118.323440;
        }
        $lat=$this->request->param('lat');
        $this->assign([
           'lat'=>$params['lat'],
            'lng'=>$params['lng']
        ]);
        return $this->fetch();
    }

}