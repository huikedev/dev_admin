<?php


namespace huikedev\dev_admin\service\system\contract;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\exception\ActionsServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\app_const\RequestMethods;
use huikedev\huike_base\app_const\ServiceReturnType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\facade\Auth;
use huikedev\huike_base\utils\UtilsTools;
use think\Exception;
use think\helper\Str;

abstract class ActionSetAbstract
{
    /**
     * @var HuikeActions
     */
    protected $actionModel;
    /**
     * @var HuikeControllers
     */
    protected $controllerModel;
    /**
     * @var HuikeModules
     */
    protected $moduleModel;
    protected $errorCode;
    abstract protected function setBaseErrorCode():void;
    public function __construct()
    {
        $this->setBaseErrorCode();
        $this->validate();
    }

    protected function validate()
    {
        // 控制器检测
        $this->controllerModel = HuikeControllers::where('id','=',AppRequest::safeInteger('controller_id'))->findOrEmpty();
        if($this->controllerModel->isEmpty()){
            throw new ActionsServiceException('控制器不存在，请确认后提交',$this->errorCode + 1,NoticeType::DIALOG_ERROR);
        }
        // 模块检测
        if(AppRequest::has('module_id')){
            $this->moduleModel = HuikeModules::where('id','=',AppRequest::safeInteger('module_id'))->findOrEmpty();
            if($this->moduleModel->isEmpty()){
                throw new ActionsServiceException('模块不存在，请确认后提交',$this->errorCode + 2,NoticeType::DIALOG_ERROR);
            }
        }
    }


    /**
     * @desc 保存方法数据，需要手动commit
     * @throws Exception
     */
    protected function setAction()
    {
        $this->actionModel->startTrans();
        try {
            $this->actionModel->action_name = UtilsTools::trimAll(AppRequest::safeString('action_name'));
            $this->actionModel->action_title = AppRequest::has('action_title') ? AppRequest::safeString('action_title') : $this->actionModel->action_name;
            $this->actionModel->controller_id = AppRequest::safeInteger('controller_id');
            $this->actionModel->route_name = AppRequest::has('route_name') ? UtilsTools::trimAll(AppRequest::safeString('route_name')) : $this->actionModel->action_name;;
            $this->actionModel->request_method = $this->getRequestMethod();
            $this->actionModel->service_return_type = $this->getServiceReturnType();
            $this->actionModel->creator_id = Auth::getUserId();
            $this->actionModel->is_need_permission = AppRequest::safeBoolean('is_need_permission');
            $this->actionModel->notice_type = AppRequest::safeInteger('notice_type');
            if(AppRequest::has('remind_msg')){
                $this->actionModel->remind_msg = AppRequest::safeString('remind_msg');
            }
            $this->actionModel->response_type = AppRequest::safeInteger('response_type');
            $this->actionModel->is_private = AppRequest::safeBoolean('is_private');
            if(AppRequest::has('remark')){
                $this->actionModel->remark = AppRequest::safeString('remark');
            }
            $this->actionModel->save();
        }catch (\Throwable $e){
            $this->actionModel->rollback();
            throw new Exception($e->getMessage());
        }
    }

    protected function getServiceReturnType(?string $returnType = null):string
    {
        if(is_null($returnType)){
            $returnType = AppRequest::safeString('service_return_type');
        }
        if(empty($returnType)){
            return 'mixed';
        }
        $returnType = UtilsTools::trimAll($returnType);
        if(Str::contains('/',$returnType) || Str::contains('\\',$returnType)){
            $returnType = UtilsTools::replaceNamespace($returnType);
            if(class_exists($returnType) === false){
                throw new ActionsServiceException('未找到【'.$returnType.'】对象',$this->errorCode + 5,NoticeType::DIALOG_ERROR);
            }
        }
        // 防止手动输入出现大小写问题
        if(in_array(strtolower($returnType),ServiceReturnType::ALL)){
            $returnType = strtolower($returnType);
        }
        return $returnType;
    }

    protected function getRequestMethod(): int
    {
        if(AppRequest::has('request_method') === false){
            return RequestMethods::ANY;
        }
        $method = strtoupper(UtilsTools::trimAll(AppRequest::safeString('request_method')));
        if(in_array($method,RequestMethods::METHODS) === false){
            return RequestMethods::ANY;
        }

        return current(array_keys(RequestMethods::METHODS,$method));
    }
}