<?php

namespace huikedev\dev_admin\service\system\provider\controller_path;



use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\service\system\exception\ControllerPathServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
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
        $path =  HuikeControllers::where('id', '=', AppRequest::id())
            ->where('path_id','=',0)
            ->findOrEmpty();
        if ($path->isEmpty()) {
            throw new ControllerPathServiceException('未找到ID为【' . AppRequest::id() . '】的目录', 11, NoticeType::DIALOG_ERROR);
        }
        if(AppRequest::has('controller_title')){
            $path->controller_title = AppRequest::safeString('controller_title');
        }
        if(AppRequest::has('route_name')){
            $path->route_name = UtilsTools::replaceSeparator(AppRequest::safeString('route_name'),'/');
        }
        $path->save();
        return true;
	}

}