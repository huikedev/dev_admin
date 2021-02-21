<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\ModelServiceException;
use huikedev\dev_admin\service\generate\support\MigrateUtils;
use Phinx\Util\Util;
use think\db\exception\PDOException;
use think\facade\Db;
use think\helper\Str;
use think\Paginator;

class Index
{
    public function handle():Paginator
    {
        $modelList = HuikeModels::with(['module'])->modelSort('update_time.desc')->append(['model_extend_text','short_migrate_file','creator'])->paginate(AppRequest::pageSize());
        foreach ($modelList->getCollection() as $model){
            try {
                $model->model_fields_count = count(Db::table($model->real_table_name)->getFields());
                $model->is_table_created = true;
            }catch (PDOException $PDOException){
                if($PDOException->getCode() === 10501){
                    $model->is_table_created = false;
                    $model->model_fields_count = 0;
                }else{
                    $model->is_table_created = false;
                    $model->model_fields_count = -1;
                }
            }catch (\Exception $e){
                $model->is_table_created = false;
                $model->model_fields_count = -1;
            }
        }
        return $modelList;
    }


}