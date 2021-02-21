<?php

namespace huikedev\dev_admin\service\system\provider\module;



use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\exception\ModuleServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;

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
         * @var HuikeModules $module
         */
	    $module = HuikeModules::where('id','=',AppRequest::id())->findOrEmpty();
	    if($module->isEmpty()){
            throw new ModuleServiceException('未找到ID为【'.AppRequest::id().'】的模块',11,NoticeType::DIALOG_ERROR);
        }
	    if(AppRequest::has('module_title')){
            $module->module_title = AppRequest::safeString('module_title');
        }
        if(AppRequest::has('route_name')){
            $module->route_name = AppRequest::safeString('route_name');
        }
        if(count(AppRequest::safeArray('bind_domain')) > 0){
            $module->bind_domain = AppRequest::safeArray('bind_domain');
        }
        $module->save();
        return true;
	}

}