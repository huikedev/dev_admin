<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\service\system\exception\ControllersServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\utils\UtilsTools;

class Edit
{
    public function handle()
    {
        /**
         * @var HuikeControllers $controller
         */
        $controller = HuikeControllers::where('id','=',AppRequest::id())->findOrEmpty();
        if($controller->isEmpty()){
            throw new ControllersServiceException('未找到指定ID为【'.AppRequest::id().'】的控制器',21,NoticeType::DIALOG_ERROR);
        }
        if(AppRequest::has('controller_title')){
            $controller->controller_title = AppRequest::safeString('controller_title');
        }
        if(AppRequest::has('service_path')){
            $controller->service_path = UtilsTools::replaceSeparator(AppRequest::safeString('service_path'));
        }
        if(AppRequest::has('exception_key')){
            $controller->exception_key = AppRequest::safeString('exception_key');
        }
        if(AppRequest::has('exception_code')){
            $controller->exception_code =$this->getExceptionCode(AppRequest::safeString('exception_code'));
        }
        if(AppRequest::has('exception_msg')){
            $controller->exception_msg =AppRequest::safeString('exception_msg');
        }
        if(AppRequest::has('route_name')){
            $controller->route_name = UtilsTools::replaceSeparator(AppRequest::safeString('route_name'),'/');
        }else{
            $controller->route_name = UtilsTools::replaceSeparator($controller->controller_name,'/');
        }
        $controller->save();

        //todo: event 更新后更新缓存提醒更新路由

        return true;
    }

    protected function getExceptionCode(int $code)
    {
        return intval(floor($code/100)*100);
    }
}