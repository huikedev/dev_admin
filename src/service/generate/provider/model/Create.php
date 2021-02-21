<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\contract\model\ModelSetAbstract;
use huikedev\dev_admin\service\generate\exception\ModelServiceException;
use huikedev\dev_admin\service\generate\support\ParseModelFields;
use huikedev\huike_generator\generator\logic_skeleton\execute\model\MakeModel;
use think\Collection;

class Create extends ModelSetAbstract
{
    public function handle()
    {
        if($this->modelConfig->isExists()){
            throw new ModelServiceException($this->modelFullName . ' is Exist',11,NoticeType::DIALOG_ERROR);
        }
        if(AppRequest::safeBoolean('is_create_model')){
            try{
                $modelMaker = new MakeModel();
                $modelMaker->setModelFullName($this->modelFullName)
                    ->setAddonFields($this->addonFields)
                    ->setModelPk($this->primary)
                    ->setModelFile($this->modelFile)
                    ->setIsJsonAssoc(AppRequest::safeBoolean('is_json_assoc'))
                    ->setExtendModel($this->modelExtend)
                    ->setModelConnection(AppRequest::safeString('connection_name'))
                    ->setModelTable(AppRequest::safeString('table_name'));
                $modelMaker->handle();
            }catch (\Throwable $e){
                throw new ModelServiceException($e->getMessage(),12,NoticeType::DIALOG_ERROR,$e);
            }
        }
        $this->modelConfig->startTrans();
        try {
            $this->setModel();
        }catch (\Throwable $e){
            $this->modelConfig->rollback();
            if(isset($modelMaker) && $modelMaker instanceof MakeModel && file_exists($modelMaker->getModelPath())){
                unlink($modelMaker->getModelPath());
            }
            throw new ModelServiceException($e->getMessage(),13,NoticeType::DIALOG_ERROR,$e);
        }
        $this->modelConfig->commit();
        return true;
    }



}