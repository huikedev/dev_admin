<?php


namespace huikedev\dev_admin\logic\controller\user;

use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\app_const\response\AppResponseType;
use huikedev\huike_base\base\BaseLogic;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\dev_admin\service\user\facade\LoginService;

/**
 * Desc
 * Class Login
 * @package huikedev\dev_admin\logic\controller\dev
 */
class Login extends BaseLogic
{
    public function index()
    {
        try {
            $this->data = LoginService::index();
            $this->noticeType = NoticeType::MESSAGE_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

	 /**
	 * @desc 测试
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function Test():self
	{
	    //$this->returnType = AppResponseType::HTML;
		try{
			$this->data = LoginService::Test();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}