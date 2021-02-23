<?php

namespace huikedev\dev_admin\service\generate\provider\migrate;



use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\MigrateServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class TableToMigration
{
    

	 /**
	 * @desc 表字段生成迁移文件
	 * @huike handler
	 * @return bool
	 */
	public function handle():bool
	{
        /**
         * @var HuikeModels $model
         */
		$model = HuikeModels::with(['module'])->where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
		if($model->isEmpty()){
            throw new MigrateServiceException('为找到指定ID为【'.AppRequest::id().'】的模型数据',31,NoticeType::DIALOG_ERROR);
        }
        try {
            $tableToMigration = new \huikedev\huike_generator\migration\TableToMigration();
            $tableToMigration->setPath($model->migration_path)->handle($model->real_table_name);
        }catch (\Exception $e){
            throw new MigrateServiceException($e->getMessage(),32,NoticeType::DIALOG_ERROR,$e);
        }
        $model->migrate_file = pathinfo($tableToMigration->getMigrateFile(),PATHINFO_FILENAME);
        $model->migrate_version = $tableToMigration->getVersion();
        $model->save();
        return true;
	}

}