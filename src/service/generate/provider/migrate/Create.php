<?php


namespace huikedev\dev_admin\service\generate\provider\migrate;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\MigrateServiceException;
use huikedev\dev_admin\service\generate\support\ParseModelFields;
use huikedev\huike_base\utils\UtilsTools;
use huikedev\huike_generator\migration\FillMigration;
use huikedev\huike_generator\migration\MakeMigration;
use think\db\exception\PDOException;
use think\Exception;
use think\facade\Db;
use think\helper\Str;

class Create
{
    public function handle()
    {
        /**
         * @var HuikeModels $model
         */
        $model = HuikeModels::where('id','=',AppRequest::id())->findOrEmpty();
        if($model->isEmpty()){
            throw new MigrateServiceException('未找到ID为【'.AppRequest::id().'】的模型',1,NoticeType::DIALOG_ERROR);
        }
        // 检查数据表是否已存在
        try {
            Db::table($model->real_table_name)->getFields();
            throw new Exception('数据表【'.$model->real_table_name.'】已存在');
        }catch (PDOException $PDOException){
            if($PDOException->getCode() !== 10501){
                throw new MigrateServiceException('数据表【'.$model->real_table_name.'】已存在',2,NoticeType::DIALOG_ERROR);
            }
        }catch (\Exception $e){
            throw new MigrateServiceException($e->getMessage(),3,NoticeType::DIALOG_ERROR,$e);
        }
        // 创建空的数据库迁移文件
        try {
            $migrateFile = (new MakeMigration())->setPath($model->migration_path)->handle(Str::studly($model->real_table_name));
        }catch (\Exception $e){
            throw new MigrateServiceException($e->getMessage(),4,NoticeType::DIALOG_ERROR,$e);
        }
        $timestampFields = [];
        if($model->is_create_time){
            $timestampFields[] = 'create_time';
        }
        if($model->is_update_time){
            $timestampFields[] = 'update_time';
        }
        if($model->is_delete_time){
            $timestampFields[] = 'delete_time';
        }
        $pk = empty($model->pk_name) ? 'id' : $model->pk_name;
        try {
            $parseFields = (new ParseModelFields(AppRequest::safeArray('model_fields'),$timestampFields,$pk))->handle();
        }catch (\Exception $e){
            unlink($migrateFile);
            throw new MigrateServiceException($e->getMessage(),5,NoticeType::DIALOG_ERROR,$e);
        }
        try {
            (new FillMigration())->handle($model->real_table_name,$migrateFile,$parseFields->getCollection(),$model->remark);
        }catch (\Exception $e){
            unlink($migrateFile);
            throw new MigrateServiceException($e->getMessage(),2,NoticeType::DIALOG_ERROR,$e);
        }
        $model->migrate_file = UtilsTools::replaceSeparator(str_replace(app()->getRootPath(),'',$migrateFile));
        $model->save();
        return true;
    }


}