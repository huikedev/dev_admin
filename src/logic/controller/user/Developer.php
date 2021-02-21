<?php

namespace huikedev\dev_admin\logic\controller\user;

use huikedev\huike_base\base\BaseLogic;
use huikedev\dev_admin\service\user\DeveloperService;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\app_const\NoticeType;


class Developer extends BaseLogic
{
    

	 /**
	 * @desc 列表
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function index():self
	{
		try{
			$this->data = DeveloperService::index();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 修改
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function update():self
	{
		try{
			DeveloperService::update();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '开发者信息修改成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 删除
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function delete():self
	{
		try{
			DeveloperService::delete();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '开发者删除成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 岗位列表
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function positionList():self
	{
		try{
			$this->data = DeveloperService::positionList();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 新增
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function create():self
	{
		try{
			DeveloperService::create();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '开发者添加成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}