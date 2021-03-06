<?php

namespace huikedev\dev_admin\service\system\provider\controller_path;



use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\service\system\exception\ControllerPathServiceException;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class Delete
{


    /**
     * @desc 删除 删除
     * @huike handler
     * @return bool
     * @throws ControllerPathServiceException
     */
	public function handle():bool
	{
		$subControllerCount = HuikeControllers::where('path_id','=',AppRequest::id())->count();
		if($subControllerCount > 0){
            throw new ControllerPathServiceException('指定ID为【'.AppRequest::id().'】的控制器目录下有'.$subControllerCount.'个控制器存在，无法删除',31);
        }
		$pathController = HuikeControllers::where('id','=',AppRequest::id())->where('path_id','=',0)->findOrEmpty();
        if(DataPermission::canEdit($pathController) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
		if($pathController->isExists()){
            $pathController->delete();
        }
		return true;
	}

}