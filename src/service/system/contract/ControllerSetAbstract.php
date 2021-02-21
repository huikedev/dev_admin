<?php


namespace huikedev\dev_admin\service\system\contract;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\exception\ControllersServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;

abstract class ControllerSetAbstract
{
    /**
     * @var HuikeControllers
     */
    protected $controller;
    protected $controllerName;
    /**
     * @var HuikeModules
     */
    protected $module;

    protected function setPath()
    {

    }

    protected function getExceptionCode(): int
    {
        $code = AppRequest::param('exception_code');
        if(is_numeric($code)){
            return intval(floor($code / 100) * 100);
        }
        if($code === '++'){
            $nowCode = HuikeControllers::where('path_id','>',0)->order('exception_code','DESC')->findOrEmpty();
            return $nowCode->exception_code + 100;
        }
        if($code === '--'){
            $nowCode = HuikeControllers::where('path_id','>',0)->order('exception_code','ASC')->findOrEmpty();
            return $nowCode->exception_code - 100;
        }
        throw new ControllersServiceException('基础异常码设置错误，请重新输入',8,NoticeType::DIALOG_ERROR);
    }
}