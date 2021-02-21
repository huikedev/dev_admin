<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\huike_base\facade\AppRequest;

class Delete
{
    public function handle()
    {

        $model = HuikeActions::with(['controller'=>['module']])->where('id','=',AppRequest::id())->findOrEmpty();
        if($model->isEmpty()){
            return true;
        }
        $isDeleteService = AppRequest::safeBoolean('delete_service');
        if($isDeleteService){
            $reflectClass = new \ReflectionClass($model->action_serice_class);
        }
        $model->delete();
        return true;
    }
}