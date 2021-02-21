<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\service\system\contract\ControllerSetAbstract;
use huikedev\dev_admin\service\system\exception\ControllersServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\utils\UtilsTools;
use think\helper\Str;

class Sync extends ControllerSetAbstract
{
    public function handle()
    {
        $path = AppRequest::safeString('path');
        $moduleId = AppRequest::safeInteger('module_id');
        /**
         * @var HuikeControllers $pathModel
         */
        $pathModel = HuikeControllers::where('path_id','=',0)
            ->where('module_id','=',$moduleId)
            ->where('controller_name','=',$path)
            ->findOrEmpty();
        $saveNewPath = false;
        if($pathModel->isEmpty()){
            $pathModel->startTrans();
            try {
                $pathModel->module_id = $moduleId;
                $pathModel->controller_name = UtilsTools::replaceSeparator($path);
                $pathModel->controller_title = $pathModel->controller_name;
                $pathModel->path_id = 0;
                $pathModel->created_by_huike = 1;
                $pathModel->route_name = UtilsTools::replaceSeparator($path,'/');
                $pathModel->save();
                $saveNewPath = true;
            }catch (\Exception $e){
                $pathModel->rollback();
                throw new ControllersServiceException($e->getMessage(),1,NoticeType::DIALOG_ERROR,$e);
            }
        }
        /**
         * @var HuikeControllers $controller
         */
        $controller = HuikeControllers::where('path_id','=',$pathModel->id)
            ->where('module_id','=',$moduleId)
            ->where('controller_name','=',AppRequest::safeString('name'))
            ->findOrEmpty();
        try {
            $controller->module_id = $moduleId;
            $controller->controller_name = AppRequest::safeString('name');
            $controller->controller_title = AppRequest::safeString('controller_title');
            $controller->path_id = $pathModel->id;
            $controller->created_by_huike = 1;
            $controller->route_name = UtilsTools::replaceSeparator(AppRequest::safeString('route_name'),'/');
            $controller->exception_key = AppRequest::safeString('exception_key');
            $controller->exception_code = $this->getExceptionCode();
            $controller->exception_msg = AppRequest::safeString('exception_msg');
            $controller->save();
        }catch (\Exception $e){
            if($saveNewPath){
                $pathModel->rollback();
            }
            $controller->rollback();
            throw new ControllersServiceException($e->getMessage(),2,NoticeType::DIALOG_ERROR,$e);
        }
        if($saveNewPath){
            $pathModel->commit();
        }
        $controller->commit();
        return true;
    }

}