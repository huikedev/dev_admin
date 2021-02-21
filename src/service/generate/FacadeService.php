<?php


namespace huikedev\dev_admin\service\generate;

// HuikeServiceImportStart
use huikedev\dev_admin\service\generate\contract\GenerateServiceAbstract;
use huikedev\dev_admin\service\generate\provider\facade\Create;
use huikedev\dev_admin\service\generate\provider\facade\Delete;
use huikedev\dev_admin\service\generate\provider\facade\Index;
use huikedev\dev_admin\service\generate\provider\facade\Refresh;
use think\Paginator;
use huikedev\dev_admin\service\generate\provider\facade\UpdateServiceFacade;
// HuikeServiceImportEnd
class FacadeService extends GenerateServiceAbstract
{

    public function index():Paginator
    {
        return app(Index::class,[],true)->handle();
    }

    public function create():bool
    {
        return app(Create::class,[],true)->handle();
    }


    public function delete():bool
    {
        return app(Delete::class,[],true)->handle();
    }

    public function refresh():bool
    {
        return app(Refresh::class,[],true)->handle();
    }

	 /**
	 * @desc 刷新服务门面
	 * @huike service
	 * @return bool
	 */
	public function updateServiceFacade():bool
	{
		return app(UpdateServiceFacade::class,[],true)->handle();
	}

}