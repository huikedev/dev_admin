<?php


namespace huikedev\dev_admin\service\system\provider\module;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeExtendModules;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\dev_admin\service\system\exception\ModuleServiceException;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\facade\FileSystem;
use huikedev\huike_base\interceptor\auth\facade\Auth;
use huikedev\huike_base\utils\UtilsTools;
use huikedev\huike_generator\generator\logic_skeleton\execute\middleware\MakeRouteMiddleware;
use think\Exception;

class Create
{
    protected $controllerPath;
    /**
     * @var array
     */
    protected $createdRouteMiddleware = [];
    protected $createdRouteMiddlewareFile;
    public function __construct()
    {
        $this->controllerPath = app()->getAppPath().'controller'.DIRECTORY_SEPARATOR;
    }
    public function handle()
    {
        $isExtend = AppRequest::safeBoolean('is_extend');
        $moduleName = UtilsTools::trimAll(AppRequest::safeString('module_name'));
        $this->createRouteMiddleware($moduleName);
        $bindDomains = [];
        foreach (AppRequest::safeArray('bind_domain') as $bindDomain){
            $bindDomains[] = UtilsTools::trimAll($bindDomain);
        }
        try {
            if($isExtend){
                $extendModule = new HuikeExtendModules();
                $extendModule->startTrans();
                try {
                    $rootPath = UtilsTools::replaceSeparator(AppRequest::safeString('root_path'));
                    $rootPath = str_replace(app()->getRootPath(),'',$rootPath);
                    $extendModule->root_path = $rootPath;
                    $extendModule->root_namespace = UtilsTools::replaceNamespace(AppRequest::safeString('root_namespace'));
                    if(AppRequest::has('root_base_exception')){
                        $extendModule->root_base_exception = UtilsTools::replaceNamespace(AppRequest::safeString('root_base_exception'));
                    }
                    if(AppRequest::has('root_base_model')){
                        $extendModule->root_base_model = UtilsTools::replaceNamespace(AppRequest::safeString('root_base_model'));
                    }
                    if(AppRequest::has('root_base_controller')){
                        $extendModule->root_base_controller = UtilsTools::replaceNamespace(AppRequest::safeString('root_base_controller'));
                    }
                    if(AppRequest::has('root_base_logic')){
                        $extendModule->root_base_logic = UtilsTools::replaceNamespace(AppRequest::safeString('root_base_logic'));
                    }
                    $extendModule->save();
                }catch (\Exception $e){
                    $extendModule->rollback();
                    throw new Exception($e->getMessage(),$e->getCode(),$e);
                }
            }
            /**
             * @var HuikeModules $module
             */
            $module = HuikeModules::where('module_name','=',$moduleName)->findOrEmpty();
            if($module->isExists()){
                throw new Exception('数据库已存在【'.$moduleName.'】记录');
            }
            $module->startTrans();
            try {
                $module->module_name = $moduleName;
                $module->module_title = AppRequest::safeString('module_title');
                $module->route_name = empty(AppRequest::safeString('route_name')) ? $moduleName : AppRequest::safeString('route_name');
                $module->extend_module_id = $extendModule->id ?? 0;
                if(count($bindDomains) > 0){
                    $module->bind_domain = $bindDomains;
                }
                $module->creator_id = Auth::getUserId();
                if(count(AppRequest::safeArray('route_middleware')) > 0 || count($this->createdRouteMiddleware) > 0){
                    $module->route_middleware = array_unique(array_merge($this->createdRouteMiddleware,AppRequest::safeArray('route_middleware')));
                }
                if(is_dir($this->controllerPath.$moduleName) === false){
                    $moduleMake = mkdir($this->controllerPath.$moduleName, 0755, true);
                }
                $module->save();
            }catch (\Exception $e){
                if(isset($extendModule->id)){
                    $extendModule->rollback();
                }
                $module->rollback();
                throw new Exception($e->getMessage(),$e->getCode(),$e);
            }

            $controller = new HuikeControllers();
            $controller->startTrans();
            try {
                $controller->controller_name = '/';
                $controller->module_id = $module->id;
                $controller->controller_title = '模块根目录';
                $controller->creator_id = Auth::getUserId();
                $controller->created_by_huike = 1;
                $controller->save();
            }catch (\Exception $e){
                if(isset($extendModule->id)){
                    $extendModule->rollback();
                }
                $module->rollback();
                $controller->rollback();
                throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
            if(isset($extendModule->id)){
                $extendModule->commit();
            }
            $module->commit();
            $controller->commit();
            return true;
        }catch (\Exception $e){
            if(is_null($this->createdRouteMiddlewareFile)===false){
                unlink($this->createdRouteMiddlewareFile);
            }
            if(isset($moduleMake) && $moduleMake){
                FileSystem::deleteEmptyDirectoriesRecursive($this->controllerPath.$moduleName);
            }
            throw new ModuleServiceException($e->getMessage(),4,NoticeType::DIALOG_ERROR,$e);
        }
    }

    protected function createRouteMiddleware(string $moduleName)
    {
        $path = AppRequest::has('root_path') ? AppRequest::safeString('root_path') :'huike';
        $namespacePrefix = AppRequest::has('root_namespace') ? AppRequest::safeString('root_namespace') :'huike';
            try {
                $makeRouteMiddleware = (new MakeRouteMiddleware())->setPath($path)->setNamespacePrefix($namespacePrefix)->handle($moduleName);
                $this->createdRouteMiddleware[] = $makeRouteMiddleware->getFullClassName();
                $this->createdRouteMiddlewareFile = $makeRouteMiddleware->getFile();
            }catch (\Exception $e){
                throw new ModuleServiceException($e->getMessage(),3,NoticeType::DIALOG_ERROR);
            }

    }
}