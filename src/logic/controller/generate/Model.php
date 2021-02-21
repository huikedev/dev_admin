<?php


namespace huikedev\dev_admin\logic\controller\generate;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\base\BaseLogic;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\dev_admin\service\generate\facade\ModelService;

class Model extends BaseLogic
{
    public function index()
    {
        try{
            $this->data = ModelService::index();
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    public function simpleList()
    {
        try{
            $this->data = ModelService::simpleList();
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    /*
     * 创建模型
     */
    public function create()
    {
        try{
            ModelService::create();
            $this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
            $this->msg = '模型生成成功';
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    /*
     * 更新注解
     */
    public function updateAnnotation()
    {
        try{
            ModelService::updateAnnotation();
            $this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
            $this->msg = '更新注解成功！';
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    public function delete()
    {
        try{
            ModelService::delete();
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
            $this->msg = '模型删除成功！';
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    public function read()
    {
        try{
            $this->data = ModelService::read();
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    public function syncProperty()
    {
        try{
            ModelService::syncProperty();
            $this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
            $this->msg = '模型属性同步成功！';
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }


    public function getFields()
    {
        try{
            $this->data = ModelService::getFields();
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }
    
}