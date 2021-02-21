<?php

namespace huikedev\dev_admin\logic\controller\system;

use huikedev\huike_base\base\BaseLogic;
use huikedev\dev_admin\service\system\ControllerPathService;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\app_const\NoticeType;


class ControllerPath extends BaseLogic
{
    

	 /**
	 * @desc 首页 首页
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function index():self
	{
		try{
			$this->data = ControllerPathService::index();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 新增 新增
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function create():self
	{
		try{
			ControllerPathService::create();
			$this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
			$this->msg = '控制器目录创建成功！';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 修改 修改
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function edit():self
	{
		try{
			ControllerPathService::edit();
			$this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
			$this->msg = '控制器目录修改成功！';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 删除 删除
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function delete():self
	{
		try{
			ControllerPathService::delete();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '控制器目录删除成功！';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 简单列表
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function simpleList():self
	{
		try{
			$this->data = ControllerPathService::simpleList();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}