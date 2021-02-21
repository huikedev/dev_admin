<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\contract\ControllerSetAbstract;
use huikedev\dev_admin\service\system\exception\ControllersServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\facade\Auth;
use huikedev\huike_base\utils\UtilsTools;

class Create extends ControllerSetAbstract
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

    public function handle()
    {
        $this->module = HuikeModules::where('id', '=', AppRequest::safeInteger('module_id'))->findOrEmpty();
        if ($this->module->isEmpty()) {
            throw new ControllersServiceException('未找到ID为【' . AppRequest::safeInteger('module_id') . '】的模块', 1, NoticeType::DIALOG_ERROR);
        }

        $this->controllerName = AppRequest::safeString('controller_name');

        if (preg_match('/^[A-Za-z]+$/', $this->controllerName, $match) === false) {
            throw new ControllersServiceException('控制器仅支持大小写字母的组合', 2, NoticeType::DIALOG_ERROR);
        }

        if (empty(AppRequest::safeString('exception_key'))) {
            throw new ControllersServiceException('请输入基础异常Key', 4, NoticeType::DIALOG_ERROR);
        }

        if (empty(AppRequest::safeString('exception_msg'))) {
            throw new ControllersServiceException('请输入基础异常msg', 5, NoticeType::DIALOG_ERROR);
        }
        $this->controller =  HuikeControllers::withTrashed()->where('module_id', '=', $this->module->id)
            ->where('controller_name', '=', $this->controllerName)
            ->where('path_id','>',0)
            ->findOrEmpty();
        if ($this->controller->isExists() && $this->controller->delete_time === 0) {
            throw new ControllersServiceException('控制器/目录已存在于数据表中，数据ID为【' . $this->controller->id . '】', 2, NoticeType::DIALOG_ERROR);
        }
        if ($this->controller->delete_time > 0) {
            $this->controller->restore();
        }
        $this->controller->startTrans();
        try {
            $this->controller->module_id = $this->module->id;
            $this->controller->controller_name = $this->controllerName;
            $this->controller->controller_title = AppRequest::safeString('controller_title');
            $this->controller->creator_id = Auth::getUserId();
            $this->controller->path_id = AppRequest::safeString('path_id');
            $this->controller->controller_title = AppRequest::safeString('controller_title');
            $this->controller->created_by_huike = 1;
            $this->controller->exception_key = AppRequest::safeString('exception_key');
            $this->controller->exception_code = $this->getExceptionCode();
            $this->controller->exception_msg = AppRequest::safeString('exception_msg');
            $this->controller->is_static_service = AppRequest::safeBoolean('is_static_service');
            if (AppRequest::has('route_name') === false) {
                $this->controller->route_name = UtilsTools::replaceSeparator($this->controllerName, '/');
            } else {
                $this->controller->route_name = UtilsTools::replaceSeparator(AppRequest::safeString('route_name'), '/');
            }
            $this->controller->save();
        } catch (\Exception $e) {
            $this->controller->rollback();
            if (isset($this->controller->delete_time) && $this->controller->delete_time > 0) {
                $this->controller->delete();
            }
            throw new ControllersServiceException($e->getMessage(), 7, NoticeType::DIALOG_ERROR, $e);
        }
        $this->controller->commit();
        return true;
    }
}