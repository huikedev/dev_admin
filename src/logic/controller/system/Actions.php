<?php


namespace huikedev\dev_admin\logic\controller\system;


use huikedev\dev_admin\service\system\facade\ActionsService;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\base\BaseLogic;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\exceptions\AppServiceException;

class Actions extends BaseLogic
{
    public function index()
    {
        try {
            $this->data = ActionsService::index();
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function create()
    {
        try {
            $this->data = ActionsService::create();
            $this->msg = '控制器方法生成成功';
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function edit()
    {
        try {
            ActionsService::edit();
            $this->msg = '控制器方法编辑成功';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function delete()
    {
        try {
            ActionsService::delete();
            $this->msg = '控制器方法删除成功';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function unSynced()
    {
        try {
            $this->data = ActionsService::unSynced();
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function sync()
    {
        try {
            ActionsService::sync();
            $this->msg = '控制器方法同步成功';
            $this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }


	 /**
	 * @desc 一键创建方法 一键生成CURD
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function speedCreate():self
	{
		try{
			$this->data = ActionsService::speedCreate();
			$this->msg = '一键创建方法成功，请确认相关文件以及备份文件！';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}