<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class Delete
{
    public function handle()
    {
        $model = HuikeControllers::where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if($model->isEmpty()){
            return true;
        }
        $model->delete();

        HuikeActions::destroy(function ($query){
            $query->where('controller_id','=',AppRequest::id());
        });
        return true;
    }
}