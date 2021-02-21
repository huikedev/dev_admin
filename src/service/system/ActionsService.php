<?php


namespace huikedev\dev_admin\service\system;


use huikedev\dev_admin\service\system\provider\actions\Index;
use huikedev\dev_admin\service\system\provider\actions\Create;
use huikedev\dev_admin\service\system\provider\actions\Edit;
use huikedev\dev_admin\service\system\provider\actions\Delete;
use huikedev\dev_admin\service\system\provider\actions\UnSynced;
use huikedev\dev_admin\service\system\provider\actions\Sync;
use huikedev\dev_admin\service\system\provider\actions\SpeedCreate;

class ActionsService
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


	 /**
	 * @desc 一键创建方法 一键生成CURD
	 * @huike service
	 * @return mixed
	 */
	public function speedCreate()
	{
		return app(SpeedCreate::class,[],true)->handle();
	}

}