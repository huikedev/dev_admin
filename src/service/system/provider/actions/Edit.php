<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\service\system\exception\ActionsServiceException;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class Edit
{
    public function handle()
    {
        $model = HuikeActions::where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if($model->isEmpty()){
            throw new ActionsServiceException('未找到指定ID为【'.AppRequest::id().'】的逻辑方法',11);
        }

        if(AppRequest::has('action_title')){
            $model->action_title = AppRequest::safeString('action_title');
        }
        if(AppRequest::has('route_name')){
            $model->route_name = AppRequest::safeString('route_name');
        }

        $model->save();
        return true;
    }
}