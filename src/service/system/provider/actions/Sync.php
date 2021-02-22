<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\service\system\contract\ActionSetAbstract;
use huikedev\dev_admin\service\system\exception\ActionsServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;

class Sync extends ActionSetAbstract
{
    public function handle()
    {
        $this->actionModel = HuikeActions::withTrashed()->where('controller_id','=',AppRequest::safeInteger('controller_id'))
            ->where('action_name','=',AppRequest::safeString('action_name'))
            ->findOrEmpty();
        if($this->actionModel->isExists() && $this->actionModel->delete_time === 0){
            throw new ActionsServiceException('当前方法【'.AppRequest::safeString('full_action_name').'】数据库已存在',$this->errorCode + 3,NoticeType::DIALOG_ERROR);
        }
        if($this->actionModel->delete_time > 0){
            $this->actionModel->restore();
        }
        try {
            $this->setAction();
        }catch (\Exception $e){
            if($this->actionModel->delete_time > 0){
                $this->actionModel->delete();
            }
            throw new ActionsServiceException($e->getMessage(),$this->errorCode + 4,NoticeType::DIALOG_ERROR);
        }
        $this->actionModel->commit();
        return true;
    }

    protected function setBaseErrorCode(): void
    {
        $this->errorCode = 50;
    }


}