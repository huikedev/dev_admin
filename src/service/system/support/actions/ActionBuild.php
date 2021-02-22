<?php


namespace huikedev\dev_admin\service\system\support\actions;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\huike_generator\generator\logic_skeleton\execute\controller\MakeController;
use huikedev\huike_generator\generator\logic_skeleton\execute\logic\MakeLogicClass;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeService;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeServiceException;
use huikedev\huike_generator\generator\logic_skeleton\execute\service\MakeServiceHandler;

class ActionBuild
{
    /**
     * @var HuikeActions
     */
    protected $action;
    protected $result = [];
    public function __construct(HuikeActions $action)
    {
        $this->action = $action;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function handle(): ActionBuild
    {
        $this->serviceExceptionBuild();
        $this->serviceHandlerBuild();
        $this->serviceBuild();
        $this->logicBuild();
        $this->controllerBuild();
        return $this;
    }

    protected function serviceExceptionBuild()
    {
        $this->result['exception'] = (new MakeServiceException())->handle($this->action)->getResult();
    }

    protected function serviceHandlerBuild()
    {
        $this->result['handler'] = (new MakeServiceHandler())->handle($this->action)->getResult();
    }
    protected function serviceBuild()
    {
        $this->result['service'] = (new MakeService())->handle($this->action,true)->getResult();
    }
    protected function logicBuild()
    {
        $this->result['logic'] = (new MakeLogicClass())->handle($this->action,true)->getResult();
    }
    protected function controllerBuild()
    {
        $this->result['controller'] = (new MakeController())->handle($this->action,true)->getResult();
    }

}