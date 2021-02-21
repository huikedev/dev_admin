<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\ModelServiceException;

class Read
{
    public function handle():HuikeModels
    {
        /**
         * @var HuikeModels $model
         */
        $model = HuikeModels::where('id','=',AppRequest::id())->append(['model_extend_text'])->findOrEmpty();
        if($model->isEmpty()){
            throw new ModelServiceException('未找到ID为【'.AppRequest::id().'】的模型',31,NoticeType::DIALOG_ERROR);
        }
        return $model;
    }
}