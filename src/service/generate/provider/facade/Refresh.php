<?php


namespace huikedev\dev_admin\service\generate\provider\facade;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeFacades;
use huikedev\dev_admin\service\generate\exception\FacadeServiceException;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;
use huikedev\huike_generator\generator\logic_skeleton\execute\facade\MakeFacade;

class Refresh
{
    public function handle()
    {
        $facade = HuikeFacades::where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($facade) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if($facade->isEmpty()){
            throw new FacadeServiceException('未找到ID为【'.AppRequest::id().'】的门面类记录',51,NoticeType::DIALOG_ERROR);
        }
        if(isset($facade->facade_class)===false || empty($facade->facade_class)){
            throw new FacadeServiceException('ID为【'.AppRequest::id().'】的未生成门面类',52,NoticeType::DIALOG_ERROR);
        }

        try {
            $facadeMaker = new MakeFacade();
            if(empty($facade->facade_path) === false){
                $facadeMaker->setPath($facade->facade_path);
            }
            $makeFacade = $facadeMaker->handle($facade->origin_class,$facade->facade_class,true);
        }catch (\Exception $e){
            throw new FacadeServiceException($e->getMessage(),53,NoticeType::DIALOG_ERROR,$e);
        }

        $facade->action_count = $makeFacade->getCount();
        $facade->update_times = isset($facade->update_times) ? $facade->update_times + 1 : 1;
        $facade->save();
        return true;
    }
}