<?php


namespace huikedev\dev_admin\service\system\provider\actions;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_base\facade\AppRequest;
use huike\common\init\HuikePaginator;
use huikedev\huike_base\utils\UtilsTools;
use think\Collection;

class UnSynced
{
    /**
     * @var int
     */
    protected $total = 0;
    /**
     * @var int
     */
    /**
     * @var int
     */
    protected $index = 0;
    /**
     * @var Collection
     */
    protected $actions;
    protected $start = 0;

    public function __construct()
    {
        $this->actions = new Collection();
        $this->start = (AppRequest::current() - 1)*AppRequest::pageSize();
    }

    public function handle()
    {
        $controllerModel = HuikeControllers::with('module')->where('path_id','>',0);
        if(AppRequest::id() > 0){
            $controllerModel->where('id','=',AppRequest::id());
        }
        $controllers = $controllerModel->select();
        foreach ($controllers as $controller){
            $this->parseActions($controller);
        }
        return  HuikePaginator::make($this->actions->slice($this->start,AppRequest::pageSize()),AppRequest::pageSize(),AppRequest::current(),$this->actions->count());
    }

    protected function parseActions(HuikeControllers $controller):void
    {
        $controllerFile = UtilsTools::replaceSeparator(app()->getRootPath().$controller->controller_class.'.php');
        $actions = UtilsTools::getMethodsFromClassFile($controllerFile,T_PUBLIC);
        foreach ($actions as $action){
            $actionModel = HuikeActions::where('controller_id','=',$controller->id)->where('action_name','=',$action['method'])->findOrEmpty();
            if($actionModel->isEmpty()){
                $this->index = $this->index + 1;
                $actionName = (empty($controller->module->module_name) ? '' : UtilsTools::replaceNamespace($controller->module->module_name).'\\').$controller->controller_name;
                $actionName .='::'.$action['method'].'()';
                $this->actions->push([
                    'index'=>$this->index,
                    'action_name'=>$action['method'],
                    'full_action_name'=>$actionName,
                    'controller_id'=>$controller->id,
                    'controller_title'=>$controller->module->module_title.'-' .$controller->controller_title,
                    'bind_domain'=>$controller->module->bind_domain,
                    'controller_route_name'=>(empty($controller->module->bind_domain) ? $controller->module->route_name.'/' : ''). $controller->route_name,
                ]);
            }
        }
    }

}