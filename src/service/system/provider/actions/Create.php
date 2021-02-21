<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\service\system\contract\ActionSetAbstract;
use huikedev\dev_admin\service\system\exception\ActionsServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\utils\UtilsTools;
use huikedev\huike_generator\generator\logic_skeleton\execute\controller\MakeController;
use huikedev\huike_generator\generator\logic_skeleton\execute\logic\MakeLogicClass;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeService;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeServiceException;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeServiceHandler;

class Create extends ActionSetAbstract
{
    protected $result = [];
    public function handle():array
    {
        $this->actionModel = HuikeActions::withTrashed()
            ->where('controller_id','=',AppRequest::safeInteger('controller_id'))
            ->where('action_name','=',UtilsTools::trimAll(AppRequest::safeString('action_name')))->findOrEmpty();
        if($this->actionModel->isExists() && $this->actionModel->delete_time === 0){
            throw new ActionsServiceException('方法已存在，请确认后提交，若未生成代码，您可在方法列表页生成！',3,NoticeType::DIALOG_ERROR);
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
            throw new ActionsServiceException($e->getMessage(),2,NoticeType::DIALOG_ERROR);
        }
        $this->actionModel->commit();

        // 创建服务类
        if(AppRequest::safeBoolean('is_create_service')){
            $serviceException = (new MakeServiceException())->handle($this->actionModel);
            $serviceHandler = (new MakeServiceHandler())->handle($this->actionModel);
            $service = (new MakeService())->handle($this->actionModel);
            $this->result[] = $service->getResult();
            $this->result[] = $serviceHandler->getResult();
            $this->result[] = $serviceException->getResult();
        }

        // 创建逻辑类

        if(AppRequest::safeBoolean('is_create_logic')){
            $logicController = (new MakeLogicClass())->handle($this->actionModel);
            $controller = (new MakeController())->handle($this->actionModel);
            $this->result[] = $logicController->getResult();
            $this->result[] = $controller->getResult();
        }

        return $this->result;

    }


    protected function setBaseErrorCode(): void
    {
        $this->errorCode = 0;
    }
}