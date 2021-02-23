<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\facade\FileSystem;
use huikedev\huike_base\lib\ClassInfo;

class UnSynced
{
    /**
     * @var int
     */
    protected $count = 0;
    public function handle():array
    {
        $moduleListModel = HuikeModules::modelSort('update_time.desc');
        if(AppRequest::id()){
            $moduleListModel->where('id','=',AppRequest::id());
        }
        $moduleList = $moduleListModel->select();
        $controllers = [];
        foreach ($moduleList as $module){
            $controllers = array_merge($controllers,$this->getControllers($module));
        }
        $unSyncedControllers = [];
        foreach ($controllers as $controller){
            $pathModel = HuikeControllers::where('module_id','=',$controller['module_id'])
                ->where('controller_name','=',$controller['path'])
                ->where('path_id','=',0)
                ->findOrEmpty();
            if($pathModel->isEmpty()){
                $unSyncedControllers[] = $controller;
                continue;
            }
            $controllerModel = HuikeControllers::where('module_id','=',$controller['module_id'])
                ->where('path_id','=',$pathModel->id)
                ->where('controller_name','=',$controller['name'])
                ->findOrEmpty();
            if($controllerModel->isEmpty()){
                $unSyncedControllers[] = $controller;
            }
        }
        return $unSyncedControllers;
    }

    protected function getControllers(HuikeModules $module):array
    {
        $moduleControllers = [];
        if(is_dir($module->full_path) === false){
            return $moduleControllers;
        }
        $files = FileSystem::allFiles($module->full_path);
        foreach ($files as  $file){
            $classInfo = new ClassInfo($file);
            if($classInfo->isClass()){
                $temp['index'] = $this->count + 1;
                $temp['module_id'] = $module->id;
                $temp['name'] = $classInfo->getClassName();
                $temp['full_name'] = $classInfo->getFullClassName();
                $temp['action_count'] = count($this->getMethods($classInfo->getFullClassName()));
                $temp['module_title'] = $module->module_title;
                $temp['module_name'] = $module->module_name;
                $temp['path'] = $this->getPath($classInfo,$module);
                $moduleControllers[] = $temp;
                $this->count = $this->count + 1;

            }
        }
        return $moduleControllers;
    }

    protected function getPath(ClassInfo $classInfo,HuikeModules $module)
    {
        $path = str_replace(app()->getNamespace().'\\controller\\'.$module->module_name.'\\','',$classInfo->getFullClassName());
        $array = explode('\\',$path);
        array_pop($array);
        if(count($array) === 0){
            return '/';
        }else{
            return implode('\\',$array);
        }
    }


    protected function getMethods(string $className):array
    {
        $publicMethods = [];
        try {
            $methods = (new \ReflectionClass($className))->getMethods();
            foreach ($methods as $method){
                if($method->isPublic()){
                    $publicMethods[] = $method->getName();
                }
            }
        }catch (\Exception $e){

        }
        return $publicMethods;
    }
}