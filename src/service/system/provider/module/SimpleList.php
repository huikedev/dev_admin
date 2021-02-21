<?php


namespace huikedev\dev_admin\service\system\provider\module;


use huikedev\dev_admin\common\model\huike\HuikeModules;

class SimpleList
{
    public function handle()
    {
        $modules = HuikeModules::with(['extend_module'])
            ->modelSort('update_time.desc')->select();
        foreach ($modules as $module){
            $module->mapping([
                'module_title'=>'title',
                'module_name'=>'name',
                'route_name'=>'route',
                'bind_domain'=>'domain',
                'extend_module'=>'extend'
            ]);
            $module->hidden(['route_middleware','creator_id','create_time','update_time','delete_time','extend_module_id']);
        }
        return $modules->toArray();
    }
}