<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_base\utils\UtilsTools;
use think\helper\Str;

class SimpleList
{
    public function handle()
    {
        $controllers =   HuikeControllers::with(['path','module'])
            ->field(['id','controller_title','controller_name','route_name','module_id','path_id'])
            ->where('path_id','>',0)
            ->select();
        foreach ($controllers as $controller){
            /**
             * @var HuikeControllers $controller
             */
            $controller->append(['service_path'])->mapping([
                'controller_title'=>'title',
                'controller_name'=>'name',
                'route_name'=>'route'
            ]);
        }
        return $controllers;
    }
}