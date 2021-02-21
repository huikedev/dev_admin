<?php

namespace huikedev\dev_admin\logic\controller\generate;

use huikedev\huike_base\base\BaseLogic;
use huikedev\dev_admin\service\generate\facade\FacadeService;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\app_const\NoticeType;



class Facade extends BaseLogic
{
    
    

	 /**
	 * @huike logic
	 * @throws AppLogicException
	 * @return self
	 */
	public function index():self
	{
		try{
			$this->data = FacadeService::index();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 根据动态类创建门面类
	 * @huike logic
	 * @throws AppLogicException
	 * @return self
	 */
	public function create():self
	{
		try{
			FacadeService::create();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '门面创建成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 删除门面类
	 * @huike logic
	 * @throws AppLogicException
	 * @return self
	 */
	public function delete():self
	{
		try{
			FacadeService::delete();
            $this->msg = '门面删除成功';
			$this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

    /**
     * @desc 刷新门面
     * @huike logic
     * @throws AppLogicException
     * @return self
     */
    public function refresh():self
    {
        try{
            FacadeService::refresh();
            $this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
            $this->msg = '门面刷新成功';
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }


	 /**
	 * @desc 刷新服务门面
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function updateServiceFacade():self
	{
		try{
			FacadeService::updateServiceFacade();
			$this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
			$this->msg = '刷新服务门面成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}