<?php

namespace huikedev\dev_admin\service\system\provider\module;



use huikedev\dev_admin\service\system\exception\ModuleServiceException;
use huikedev\dev_admin\service\system\support\exceptions\RebuildExceptionLang;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;

class RefreshException
{


    /**
     * @desc 刷新异常配置
     * @huike handler
     * @return bool
     * @throws ModuleServiceException
     */
	public function handle():bool
	{
        try {
            (new RebuildExceptionLang())->handle(AppRequest::id());
        }catch (\Exception $e){
            throw new ModuleServiceException($e->getMessage(),41,NoticeType::DIALOG_ERROR);
        }
        return true;
	}

}