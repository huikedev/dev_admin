<?php

namespace huikedev\dev_admin\service\user;

use think\Paginator;
use huikedev\dev_admin\service\user\provider\developer\Index;
use huikedev\dev_admin\service\user\provider\developer\Update;
use huikedev\dev_admin\service\user\provider\developer\Delete;
use huikedev\dev_admin\service\user\provider\developer\PositionList;
use huikedev\dev_admin\service\user\provider\developer\Create;


class DeveloperService
{
    

	 /**
	 * @desc 列表
	 * @huike service
	 * @return Paginator
	 */
	public static function index():Paginator
	{
		return app(Index::class,[],true)->handle();
	}


	 /**
	 * @desc 修改
	 * @huike service
	 * @return bool
	 */
	public static function update():bool
	{
		return app(Update::class,[],true)->handle();
	}


	 /**
	 * @desc 删除
	 * @huike service
	 * @return bool
	 */
	public static function delete():bool
	{
		return app(Delete::class,[],true)->handle();
	}


	 /**
	 * @desc 岗位列表
	 * @huike service
	 * @return array
	 */
	public static function positionList():array
	{
		return app(PositionList::class,[],true)->handle();
	}


	 /**
	 * @desc 新增
	 * @huike service
	 * @return bool
	 */
	public static function create():bool
	{
		return app(Create::class,[],true)->handle();
	}

}