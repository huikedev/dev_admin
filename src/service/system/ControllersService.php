<?php


namespace huikedev\dev_admin\service\system;

use huikedev\dev_admin\service\system\provider\controllers\CheckException;
use huikedev\dev_admin\service\system\provider\controllers\Create;
use huikedev\dev_admin\service\system\provider\controllers\Delete;
use huikedev\dev_admin\service\system\provider\controllers\Edit;
use huikedev\dev_admin\service\system\provider\controllers\Index;
use huikedev\dev_admin\service\system\provider\controllers\SimpleList;
use huikedev\dev_admin\service\system\provider\controllers\Sync;
use huikedev\dev_admin\service\system\provider\controllers\UnSynced;
use huikedev\dev_admin\service\system\provider\controllers\Prefix;
use huikedev\dev_admin\service\system\provider\controllers\PathList;

class ControllersService
{
    public function index()
    {
        return app(Index::class,[],true)->handle();
    }

    public function create()
    {
        return app(Create::class,[],true)->handle();
    }

    public function edit()
    {
        return app(Edit::class,[],true)->handle();
    }

    public function delete()
    {
        return app(Delete::class,[],true)->handle();
    }

    public function unSynced()
    {
        return app(UnSynced::class,[],true)->handle();
    }

    public function sync()
    {
        return app(Sync::class,[],true)->handle();
    }

    public function checkException()
    {
        return app(CheckException::class,[],true)->handle();
    }

    public function simpleList()
    {
        return app(SimpleList::class,[],true)->handle();
    }

	 /**
	 * @desc 前缀列表
	 * @huike service
	 * @return array
	 */
	public function prefix():array
	{
		return app(Prefix::class,[],true)->handle();
	}


	 /**
	 * @desc 控制器目录
	 * @huike service
	 * @return array
	 */
	public function pathList():array
	{
		return app(PathList::class,[],true)->handle();
	}

}