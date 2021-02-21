<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_base\facade\AppRequest;

class Delete
{
    public function handle()
    {
        $controller = HuikeControllers::where('id','=',AppRequest::id())->findOrEmpty();

        if($controller->isEmpty()){
            return true;
        }
        $controller->delete();

        HuikeActions::destroy(function ($query){
            $query->where('controller_id','=',AppRequest::id());
        });
        return true;
    }
}