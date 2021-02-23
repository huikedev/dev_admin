<?php


namespace huikedev\dev_admin\logic\controller\system;


use huikedev\dev_admin\service\system\facade\ControllersService;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\base\BaseLogic;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\exceptions\AppServiceException;

class Controllers extends BaseLogic
{
    public function index()
    {
        try {
            $this->data = ControllersService::index();
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function create()
    {
        try {
            ControllersService::create();
            $this->msg = '控制器添加成功';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function edit()
    {
        try {
            ControllersService::edit();
            $this->msg = '控制器修改成功';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function delete()
    {
        try {
            ControllersService::delete();
            $this->msg = '控制器删除成功';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function unSynced()
    {
        try {
            $this->data = ControllersService::unSynced();
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function sync()
    {
        try {
            ControllersService::sync();
            $this->msg = '控制器同步成功';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function checkException()
    {
        try {
            $this->data = ControllersService::checkException();
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function simpleList()
    {
        try {
            $this->data = ControllersService::simpleList();
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

}