<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\ModelServiceException;
use think\facade\Console;

class UpdateAnnotation
{
    public function handle()
    {
        /**
         * @var HuikeModels $model
         */
        $model = HuikeModels::where('id','=',AppRequest::id())->findOrEmpty();
        if($model->isEmpty()){
            throw new ModelServiceException('未找到ID为【'.AppRequest::id().'】的模型',81);
        }
        if(isset($model->model_full_name)===false || empty($model->model_full_name)){
            throw new ModelServiceException('未找到模型的完整命名空间',82);
        }
        if(class_exists($model->model_full_name) === false){
            throw new ModelServiceException('未找到【'.$model->model_full_name.'】对应的模型',83);
        }
        try {
            Console::call('model:annotation',[$model->model_full_name,'--overwrite']);
        }catch (\Exception $e){
            throw new ModelServiceException('更新【'.$model->model_full_name.'】模型注解失败',84);
        }
        return true;
    }
}