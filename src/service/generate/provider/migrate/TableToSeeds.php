<?php

namespace huikedev\dev_admin\service\generate\provider\migrate;



use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\MigrateServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;
use huikedev\huike_generator\migration\TableToSeed;

class TableToSeeds
{
    

	 /**
	 * @desc 表数据生成种子文件
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
            throw new MigrateServiceException('为找到指定ID为【'.AppRequest::id().'】的模型数据',41,NoticeType::DIALOG_ERROR);
        }
        try {
            $tableToSeed = new TableToSeed();
            $tableToSeed->setPath($model->seeds_path)->handle($model->real_table_name);
        }catch (\Exception $e){
            throw new MigrateServiceException($e->getMessage(),42,NoticeType::DIALOG_ERROR,$e);
        }
        $model->seed_file = pathinfo($tableToSeed->getFilename(),PATHINFO_FILENAME);
        $model->save();
        return true;
	}

}