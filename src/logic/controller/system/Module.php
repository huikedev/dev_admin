<?php

namespace huikedev\dev_admin\logic\controller\system;

use huikedev\huike_base\base\BaseLogic;
use huikedev\dev_admin\service\system\facade\ModuleService;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\app_const\NoticeType;


class Module extends BaseLogic
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
			$this->data = ModuleService::index();
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
			ModuleService::create();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '模块创建成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 路由中间件列表
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function routeMiddlewares():self
	{
		try{
			$this->data = ModuleService::routeMiddlewares();
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
			$this->data = ModuleService::simpleList();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 第三方模块列表
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function extendModules():self
	{
		try{
			$this->data = ModuleService::extendModules();
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 修改 修改模块设置
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function edit():self
	{
		try{
			ModuleService::edit();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '修改模块设置成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 生成路由 路由生成
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function generateRouteRule():self
	{
		try{
			ModuleService::generateRouteRule();
			$this->noticeType = NoticeType::DIALOG_SUCCESS;
			$this->msg = '路由生成成功，请前往对应的模块目录查看';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}