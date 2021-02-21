<?php

namespace huikedev\dev_admin\service\user\provider\developer;



use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use huikedev\dev_admin\service\user\exception\DeveloperServiceException;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\facade\Auth;

class Create
{


    /**
     * @desc 新增
     * @huike handler
     * @return bool
     * @throws DeveloperServiceException
     */
	public function handle():bool
	{
        /**
         * @var HuikeDeveloper $developer
         */
		$developer = HuikeDeveloper::where('username','=',AppRequest::safeString('username'))->findOrEmpty();
		if($developer->isExists()){
            throw new DeveloperServiceException('开发者账号【'.AppRequest::safeString('username').'】已存在',1);
        }
        $developer->username = AppRequest::safeString('username');
        $developer->password = password_hash(AppRequest::param('password'),PASSWORD_DEFAULT);
        $developer->position_id = AppRequest::safeInteger('position_id');
        $developer->creator_id = Auth::getUserId();
        $developer->save();
        return true;
	}

}