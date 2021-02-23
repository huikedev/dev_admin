<?php

namespace huikedev\dev_admin\service\system\provider\controller_path;



use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\service\system\exception\ControllerPathServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;
use huikedev\huike_base\utils\UtilsTools;

class Edit
{
    

	 /**
	 * @desc 修改 修改
	 * @huike handler
	 * @return bool
	 */
	public function handle():bool
	{
        $model =  HuikeControllers::where('id', '=', AppRequest::id())
            ->where('path_id','=',0)
            ->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if ($model->isEmpty()) {
            throw new ControllerPathServiceException('未找到ID为【' . AppRequest::id() . '】的目录', 11, NoticeType::DIALOG_ERROR);
        }
        if(AppRequest::has('controller_title')){
            $model->controller_title = AppRequest::safeString('controller_title');
        }
        if(AppRequest::has('route_name')){
            $model->route_name = UtilsTools::replaceSeparator(AppRequest::safeString('route_name'),'/');
        }
        $model->save();
        return true;
	}

}