<?php


namespace huikedev\dev_admin\service\system\provider\module;


use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\facade\FileSystem;
use huikedev\huike_base\lib\ClassInfo;
use think\Paginator;

class Index
{
    public function handle()
    {

        $moduleList = HuikeModules::with(['extend_module'])->modelSort('update_time.desc')->append(['creator'])->paginate(AppRequest::pageSize());
        foreach ($moduleList->getCollection() as $module){
            /**
             * @var HuikeModules
             */
            $this->getControllersCount($module);
        }
        return $moduleList;
    }

    protected function getControllersCount(HuikeModules $module)
    {
        $module->controller_count = 0;
        if(is_dir($module->full_path) === false){
            $module->controller_count = -1;
            return $this;
        }
        $files = FileSystem::allFiles($module->full_path);
        foreach ($files as $file){
            $classInfo = new ClassInfo($file);
            if($classInfo->isClass()){
                $module->controller_count = $module->controller_count + 1;
            }
        }
        return $this;
    }
}