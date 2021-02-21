<?php

namespace huikedev\dev_admin\service\user\provider\developer;



use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use huikedev\dev_admin\service\user\exception\DeveloperServiceException;
use huikedev\huike_base\facade\AppRequest;

class Update
{
    

	 /**
	 * @desc 修改
	 * @huike handler
	 * @return bool
	 */
	public function handle():bool
	{
        /**
         * @var HuikeDeveloper $developer
         */
        $developer = HuikeDeveloper::where('id','=',AppRequest::id())->findOrEmpty();
        if($developer->isEmpty()){
            throw new DeveloperServiceException('未找到指定ID为【'.AppRequest::id().'】的开发者账号',11);
        }
        if(AppRequest::has('position_id')){
            $developer->position_id = AppRequest::safeInteger('position_id');
        }
        if(AppRequest::has('password')){
            $developer->password = password_hash(AppRequest::param('password'),PASSWORD_DEFAULT);
        }
        $developer->save();
        return true;
	}

}