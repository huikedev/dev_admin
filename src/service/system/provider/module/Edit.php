<?php

namespace huikedev\dev_admin\service\system\provider\module;



use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\exception\ModuleServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class Edit
{
    

	 /**
	 * @desc 修改 修改模块设置
	 * @huike handler
	 * @return bool
	 */
	public function handle():bool
	{
        /**
         * @var HuikeModules $model
         */
	    $model = HuikeModules::where('id','=',AppRequest::id())->findOrEmpty();

        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }

	    if($model->isEmpty()){
            throw new ModuleServiceException('未找到ID为【'.AppRequest::id().'】的模块',11,NoticeType::DIALOG_ERROR);
        }
	    if(AppRequest::has('module_title')){
            $model->module_title = AppRequest::safeString('module_title');
        }
        if(AppRequest::has('route_name')){
            $model->route_name = AppRequest::safeString('route_name');
        }
        if(count(AppRequest::safeArray('bind_domain')) > 0){
            $model->bind_domain = AppRequest::safeArray('bind_domain');
        }
        $model->save();
        return true;
	}

}