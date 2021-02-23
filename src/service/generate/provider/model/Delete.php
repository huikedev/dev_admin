<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;
use think\facade\Db;

class Delete
{
    public function handle():bool
    {
        /**
         * @var HuikeModels
         */
        $model = HuikeModels::where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($model) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
        if($model->isExists()){
            try {
                $facadeClass = new \ReflectionClass($model->model_full_name);
                if(file_exists($facadeClass->getFileName())){
                    unlink($facadeClass->getFileName());
                }
            }catch (\Exception $e){

            }
            $model->delete();
            if(AppRequest::safeBoolean('delete_table') === true){

                $sql = 'drop table if exists '.$model->real_table_name;
                Db::connect($model->real_connection_name)->query($sql);
            }
            if(AppRequest::safeBoolean('delete_migrate_file') === true && empty($model->migrate_file) === false){
                $migrateFile = app()->getRootPath().'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.$model->migrate_file;
                if(file_exists($migrateFile)){
                    unlink($migrateFile);
                }
            }
        }
        return true;
    }
}