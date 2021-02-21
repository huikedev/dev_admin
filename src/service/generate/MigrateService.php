<?php


namespace huikedev\dev_admin\service\generate;


use huikedev\dev_admin\service\generate\contract\GenerateServiceAbstract;
use huikedev\dev_admin\service\generate\provider\migrate\Create;
use huikedev\dev_admin\service\generate\provider\migrate\Run;
use huikedev\dev_admin\service\generate\provider\migrate\TableToMigration;
use huikedev\dev_admin\service\generate\provider\migrate\TableToSeeds;

class MigrateService extends GenerateServiceAbstract
{
    public function create():bool
    {
        return app(Create::class,[],true)->handle();
    }

    public function run():bool
    {
        return app(Run::class,[],true)->handle();
    }

	 /**
	 * @desc 表字段生成迁移文件
	 * @huike service
	 * @return bool
	 */
	public function tableToMigration():bool
	{
		return app(TableToMigration::class,[],true)->handle();
	}


	 /**
	 * @desc 表数据生成种子文件
	 * @huike service
	 * @return bool
	 */
	public function tableToSeeds():bool
	{
		return app(TableToSeeds::class,[],true)->handle();
	}

}