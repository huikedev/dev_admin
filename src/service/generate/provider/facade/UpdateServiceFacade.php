<?php

namespace huikedev\dev_admin\service\generate\provider\facade;



use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\service\generate\exception\FacadeServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeServiceFacade;

class UpdateServiceFacade
{
    

	 /**
	 * @desc 刷新服务门面
	 * @huike handler
	 * @return bool
	 */
	public function handle():bool
	{
		$controllerId = AppRequest::safeInteger('controller_id');
        /**
         * @var HuikeControllers $controller
         */
		$controller = HuikeControllers::where('id','=',$controllerId)->findOrEmpty();
		if($controller->isEmpty()){
            throw new FacadeServiceException('未找到ID为【'.$controllerId.'】的控制器',51,NoticeType::DIALOG_ERROR);
        }
		if($controller->is_static_service){
            throw new FacadeServiceException('当前控制器代理模式为静态代理，无需刷新门面',52,NoticeType::DIALOG_ERROR);
        }
        try {
            (new MakeServiceFacade())->handle($controller->service_class,0,true);
        }catch (\Exception $e){
            throw new FacadeServiceException($e->getMessage(),53,NoticeType::DIALOG_ERROR);
        }
		return true;
	}

}