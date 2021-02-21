<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\huike_base\facade\AppRequest;

class Index
{
    public function handle()
    {
        if(AppRequest::has('module_id')){
            $model = HuikeActions::hasWhere('controller',[['module_id','=',AppRequest::safeInteger('module_id')]])->with(['controller'=>['module','path']]);
        }else{
            $model = HuikeActions::with(['controller'=>['module','path']]);
        }
        if(AppRequest::has('controller_id')){
            $model->where('controller_id','=',AppRequest::safeInteger('controller_id'));
        }
        return $model->modelSort('update_time.desc')->append(HuikeActions::$commonAppends)->paginate();
    }
}