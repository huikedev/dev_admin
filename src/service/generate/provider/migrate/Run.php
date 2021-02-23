<?php


namespace huikedev\dev_admin\service\generate\provider\migrate;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\MigrateServiceException;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;
use huikedev\huike_generator\migration\RunMigration;

class Run
{
    public function handle():bool
    {
        $model = HuikeModels::where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if($model->isEmpty()){
            throw new MigrateServiceException('未找到ID为'.AppRequest::id().'的数据模型',11,NoticeType::DIALOG_ERROR);
        }
        try {
            $res = (new RunMigration())->setPath($model->migration_path)->handle($model->real_table_name);
        }catch (\Exception $e){
            throw new MigrateServiceException($e->getMessage(),13,NoticeType::DIALOG_ERROR,$e);
        }
        if($res === 0){
            throw new MigrateServiceException('数据库迁移执行失败',14,NoticeType::DIALOG_ERROR);
        }
        $model->migrate_version = $res;
        $model->save();
        return true;
    }
}