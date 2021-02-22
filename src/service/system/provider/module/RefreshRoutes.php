<?php


namespace huikedev\dev_admin\service\system\provider\module;


use huikedev\dev_admin\service\system\exception\ModuleServiceException;
use huikedev\dev_admin\service\system\support\routes\RebuildRoutes;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;

class RefreshRoutes
{
    public function handle():bool
    {
        try {
            (new RebuildRoutes())->setModuleId(AppRequest::id())->handle();
        }catch (\Exception $e){
            throw new ModuleServiceException($e->getMessage(),51,NoticeType::DIALOG_ERROR);
        }
        return true;
    }
}