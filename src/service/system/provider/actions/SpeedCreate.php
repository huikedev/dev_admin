<?php

namespace huikedev\dev_admin\service\system\provider\actions;

use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\service\system\contract\ActionSetAbstract;
use huikedev\dev_admin\service\system\exception\ActionsServiceException;
use huikedev\dev_admin\service\system\support\actions\ActionBuild;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\app_const\RequestMethods;
use huikedev\huike_base\app_const\response\AppResponseType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\facade\Auth;
use think\model\Collection;


class SpeedCreate extends ActionSetAbstract
{
    /**
     * @var Collection
     */
    protected $speedActions;
    protected $actionNames = ['index','create','delete','edit','read'];
    protected $result;
	 /**
	 * @desc 一键创建方法 一键生成CURD
	 * @huike handler
	 * @return mixed
	 */
	public function handle()
	{
        $actions = AppRequest::safeArray('actions');
        if(count($actions) === 0){
            throw new ActionsServiceException('请指定需要创建的方法',53);
        }
        $this->speedActions = new Collection();
        $this->validateActions($actions);
        $this->saveAction();
        return $this->result;
	}

	protected function saveAction()
    {
        foreach ($this->speedActions as $speedAction){
            /**
             * @var HuikeActions $speedAction
             */
            $speedAction->startTrans();
            $temp['name'] = $speedAction->action_name;
            try {
                $speedAction->save();
                $temp['result'] = (new ActionBuild($speedAction))->handle()->getResult();
                $temp['status']='success';
            }catch (\Exception $e){
                $speedAction->rollback();
                $temp['result'] = $e->getMessage();
                $temp['status']='error';
            }
            $speedAction->commit();
            $this->result[] = $temp;
        }
    }

    protected function validateActions(array $actions)
    {
        foreach ($actions as $index => $action){
            if(isset($action['is_create']) === false || boolval($action['is_create']) === false){
                continue;
            }
            if(isset($action['action_name'])===false || in_array($action['action_name'],$this->actionNames) === false){
                throw new ActionsServiceException('未找到第'.($index +1).'条数据的方法名或方法名命名不规范',54);
            }
            if(isset($action['notice_type'])===false){
                throw new ActionsServiceException('请选择第'.($index +1).'条数据的反馈类型',55);
            }
            if(isset($action['service_return_type'])===false || empty($action['service_return_type'])){
                throw new ActionsServiceException('请选择第'.($index +1).'条数据的服务返回类型',56);
            }
            if($action['notice_type'] !== 0 && (isset($action['remind_msg'])===false||empty($action['remind_msg']))){
                throw new ActionsServiceException('请输入第'.($index +1).'条数据的提示消息',57);
            }
            $actionModel = HuikeActions::where('controller_id','=',$this->controllerModel->id)
                ->where('action_name','=',$action['action_name'])
                ->findOrEmpty();
            if($actionModel->isExists()){
                throw new  ActionsServiceException('【'.$action['action_name'].'】方法已存在',58);
            }
            $actionModel->action_name = $action['action_name'];
            $actionModel->route_name = $action['action_name'];
            $actionModel->action_title = isset($action['action_title']) && empty($action['action_title']) === false ? $action['action_title'] : $action['action_name'];
            $actionModel->service_return_type = $action['service_return_type'];
            $actionModel->notice_type = $action['notice_type'];
            $actionModel->is_private = isset($action['is_private']) ? boolval($action['is_private']) : true;
            $actionModel->is_need_permission = isset($action['is_need_permission']) ? boolval($action['is_need_permission']) : true;
            $actionModel->request_method = in_array($action['action_name'],['index','read']) ? RequestMethods::GET : RequestMethods::POST;
            $actionModel->service_return_type = $this->getServiceReturnType($action['service_return_type']);
            $actionModel->creator_id = Auth::getUserId();
            if(isset($action['remind_msg']) && empty($action['remind_msg']) === false){
                $actionModel->remind_msg = $action['remind_msg'];
            }
            $actionModel->response_type = 1; // 固定值 json
            $actionModel->remark = $actionModel->action_title;
            $actionModel->controller_id = $this->controllerModel->id;
            $this->speedActions->push($actionModel);
        }
    }

    protected function setBaseErrorCode(): void
    {
        $this->errorCode = 50;
    }
}