<?php


namespace huikedev\dev_admin\service\system\support\routes;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_generator\generator\logic_skeleton\execute\routes\MakeRoutes;
use think\Exception;

class RebuildRoutes
{
    protected $controllerId;
    protected $moduleId;

    public function setControllerId(int $controllerId): RebuildRoutes
    {
        $this->controllerId = $controllerId;
        return $this;
    }

    public function setModuleId(int $moduleId): RebuildRoutes
    {
        $this->moduleId = $moduleId;
        return $this;
    }


    public function handle(): bool
    {
        if(is_null($this->moduleId) === false){
            $moduleId = $this->moduleId;
        }
        if(is_null($this->controllerId) === false){
            $controller = HuikeControllers::where('id','=',$this->controllerId)->findOrEmpty();
            if(isset($controller->module_id) === false || $controller->module_id < 1){
                throw new Exception('未找到控制器ID为【'.$this->controllerId.'】的关联模块');
            }
            $moduleId = $controller->module_id;
        }
        if(isset($moduleId) === false){
            throw new Exception('未设置【moduleId】或【controllerId】');
        }
        (new MakeRoutes())->setOverwrite(true)->handle($moduleId);
        return true;
    }
}