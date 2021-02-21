<?php

namespace huikedev\dev_admin\service\system;

use think\Paginator;
use huikedev\dev_admin\service\system\provider\controller_path\Index;
use huikedev\dev_admin\service\system\provider\controller_path\Create;
use huikedev\dev_admin\service\system\provider\controller_path\Edit;
use huikedev\dev_admin\service\system\provider\controller_path\Delete;
use huikedev\dev_admin\service\system\provider\controller_path\SimpleList;


class ControllerPathService
{
    

	 /**
	 * @desc 首页 首页
	 * @huike service
	 * @return Paginator
	 */
	public static function index():Paginator
	{
		return app(Index::class,[],true)->handle();
	}


	 /**
	 * @desc 新增 新增
	 * @huike service
	 * @return bool
	 */
	public static function create():bool
	{
		return app(Create::class,[],true)->handle();
	}


	 /**
	 * @desc 修改 修改
	 * @huike service
	 * @return bool
	 */
	public static function edit():bool
	{
		return app(Edit::class,[],true)->handle();
	}


	 /**
	 * @desc 删除 删除
	 * @huike service
	 * @return bool
	 */
	public static function delete():bool
	{
		return app(Delete::class,[],true)->handle();
	}


	 /**
	 * @desc 简单列表
	 * @huike service
	 * @return array
	 */
	public static function simpleList():array
	{
		return app(SimpleList::class,[],true)->handle();
	}

}