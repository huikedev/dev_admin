<?php

namespace huikedev\dev_admin\service\user\provider\developer;



use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use huikedev\dev_admin\service\user\exception\DeveloperServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;

class Delete
{
    

	 /**
	 * @desc 删除
	 * @huike handler
	 * @return bool
	 */
	public function handle():bool
	{
	    if(AppRequest::id()===1){
            throw new DeveloperServiceException('初始开发者账号无法删除',31,NoticeType::DIALOG_ERROR);
        }
        /**
         * @var HuikeDeveloper $developer
         */
        $developer = HuikeDeveloper::where('id','=',AppRequest::id())->findOrEmpty();
        if($developer->isExists()){
            $developer->delete();
        }
        return true;
	}

}