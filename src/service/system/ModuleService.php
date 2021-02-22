<?php

namespace huikedev\dev_admin\service\system;

use think\Paginator;
use huikedev\dev_admin\service\system\provider\module\Index;
use huikedev\dev_admin\service\system\provider\module\Create;
use huikedev\dev_admin\service\system\provider\module\SimpleList;
use huikedev\dev_admin\service\system\provider\module\ExtendModules;
use huikedev\dev_admin\service\system\provider\module\Edit;
use huikedev\dev_admin\service\system\provider\module\RefreshRoutes;
use huikedev\dev_admin\service\system\provider\module\RefreshException;


class ModuleService
{
    

	 /**
	 * @desc 列表
	 * @huike service
	 * @return Paginator
	 */
	public function index():Paginator
	{
		return app(Index::class,[],true)->handle();
	}


	 /**
	 * @desc 新增
	 * @huike service
	 * @return bool
	 */
	public function create():bool
	{
		return app(Create::class,[],true)->handle();
	}



	 /**
	 * @desc 简单列表
	 * @huike service
	 * @return array
	 */
	public function simpleList():array
	{
		return app(SimpleList::class,[],true)->handle();
	}


	 /**
	 * @desc 第三方模块列表
	 * @huike service
	 * @return array
	 */
	public function extendModules():array
	{
		return app(ExtendModules::class,[],true)->handle();
	}



	 /**
	 * @desc 修改 修改模块设置
	 * @huike service
	 * @return bool
	 */
	public function edit():bool
	{
		return app(Edit::class,[],true)->handle();
	}


	 /**
	 * @desc 生成路由 路由生成
	 * @huike service
	 * @return bool
	 */
	public function refreshRoutes():bool
	{
		return app(RefreshRoutes::class,[],true)->handle();
	}


	 /**
	 * @desc 刷新异常配置
	 * @huike service
	 * @return bool
	 */
	public function refreshException():bool
	{
		return app(RefreshException::class,[],true)->handle();
	}

}