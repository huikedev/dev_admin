<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\ModelServiceException;
use huikedev\huike_generator\migration\support\ParseTableFields;
use think\Model;

class GetFields
{
    /**
     * @var HuikeModels
     */
    protected $model;
    public function handle():Model
    {
        $this->model = HuikeModels::where('id','=',AppRequest::id())->findOrEmpty();
        if($this->model->isEmpty()){
            throw new ModelServiceException('未找到ID为【'.AppRequest::id().'】的模型',31);
        }
        try {
            $parseTableFields = (new ParseTableFields())->handle($this->model->real_table_name,$this->model->id);
            $this->model->model_fields = $parseTableFields->getTableFields()->toArray();
            return $this->model;
        }catch (\Exception $e){
            throw new ModelServiceException($e->getMessage(),72,NoticeType::DIALOG_ERROR,$e);
        }

    }
}