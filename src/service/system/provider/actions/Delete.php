<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class Delete
{
    public function handle()
    {

        $model = HuikeActions::with(['controller'=>['module']])->where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if($model->isEmpty()){
            return true;
        }

        if(AppRequest::safeBoolean('delete_service')){
            $reflectClass = new \ReflectionClass($model->service_handler);
            if(file_exists($reflectClass->getFileName())){
                unlink($reflectClass->getFileName());
            }
        }
        $model->delete();
        return true;
    }
}