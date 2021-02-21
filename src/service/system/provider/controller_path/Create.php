<?php

namespace huikedev\dev_admin\service\system\provider\controller_path;



use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\contract\ControllerSetAbstract;
use huikedev\dev_admin\service\system\exception\ControllerPathServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\facade\Auth;
use huikedev\huike_base\utils\UtilsTools;
use think\helper\Str;

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

    /**
     * @desc 新增 新增
     * @huike handler
     * @return bool
     * @throws ControllerPathServiceException
     */
	public function handle():bool
	{
        $this->module = HuikeModules::where('id', '=', AppRequest::safeInteger('module_id'))->findOrEmpty();
        if ($this->module->isEmpty()) {
            throw new ControllerPathServiceException('未找到ID为【' . AppRequest::safeInteger('module_id') . '】的模块', 1, NoticeType::DIALOG_ERROR);
        }
        $this->controllerName = UtilsTools::replaceNamespace($this->controllerName);
        $this->controller =  HuikeControllers::withTrashed()->where('module_id', '=', $this->module->id)
            ->where('controller_name', '=', $this->controllerName)
            ->where('path_id','=',0)
            ->findOrEmpty();
        if ($this->controller->isExists() && $this->controller->delete_time === 0) {
            throw new ControllerPathServiceException('控制器目录已存在于数据表中，数据ID为【' . $this->controller->id . '】', 2, NoticeType::DIALOG_ERROR);
        }
        if ($this->controller->delete_time > 0) {
            $this->controller->restore();
        }
        $this->controller->startTrans();
        try {
            $this->controller->module_id = $this->module->id;
            $this->controller->controller_name = Str::snake($this->controllerName);
            $this->controller->controller_title = AppRequest::safeString('controller_title');
            $this->controller->path_id = 0;
            $this->controller->creator_id = Auth::getUserId();
            $this->controller->created_by_huike = 1;
            if (AppRequest::has('route_name') === false) {
                $this->controller->route_name = UtilsTools::replaceSeparator($this->controller->controller_name, '/');
            } else {
                $this->controller->route_name = UtilsTools::replaceSeparator(AppRequest::safeString('route_name'), '/');
            }
            $this->controller->save();
        } catch (\Exception $e) {
            $this->controller->rollback();
            if (isset($this->controller->delete_time) && $this->controller->delete_time > 0) {
                $this->controller->delete();
            }
            throw new ControllerPathServiceException($e->getMessage(), 3, NoticeType::DIALOG_ERROR, $e);
        }
        $this->controller->commit();
        return true;
	}

}