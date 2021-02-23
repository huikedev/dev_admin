<?php


namespace huikedev\dev_admin\common\caching\provider\routes;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\common\caching\support\DevCachePrefix;
use huikedev\huike_base\base\caching\AppSettingCacheAbstract;
use huikedev\huike_base\facade\AppRequest;
use think\facade\Config;

class DevActionsCache extends AppSettingCacheAbstract
{

    protected function setPrefix()
    {
       $this->prefix = DevCachePrefix::DEV_ACTIONS;
    }

    public function isPublic(string $fullActionName=null):bool
    {
        $this->getSettingData();
        $fullActionName = is_null($fullActionName) ?AppRequest::getFullActionName() : $fullActionName;
        return isset($this->cacheData[$fullActionName]['is_private']) ? boolval($this->cacheData[$fullActionName]['is_private']==false) : true;
    }

    public function getAll()
    {
        $this->getSettingData();
        return $this->cacheData;
    }

    protected function getDataSource():array
    {
        $rules = [];
        $module = HuikeModules::where('module_name','=','dev')->findOrEmpty();
        if($module->isEmpty()){
            return $rules;
        }
        $controllers = HuikeControllers::with('path')->where('module_id','=',$module->id)
            ->where('path_id','>',0)
            ->select();
        $controllerIds = $controllers->column('id');
        $actions = HuikeActions::where('controller_id','in',$controllerIds)->select();
        foreach ($actions as $action){
            $controller = $controllers->where('id','=',$action->controller_id)->first();
            $actionString = $module->module_name.'.';
            if(isset($controller->path->controller_name) && (empty($controller->path->controller_name) === false || $controller->path->controller_name !=='/')){
                $actionString .=$controller->path->controller_name.'.';
            }
            $actionString .=$controller->controller_name.'/'.$action->action_name;
            $rules[$actionString] = [
                'id'=>$action->id,
                'is_private'=>$action->is_private
            ];
        }
        return $rules;
    }
}