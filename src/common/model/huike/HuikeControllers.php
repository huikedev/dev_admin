<?php

namespace huikedev\dev_admin\common\model\huike;

use huikedev\dev_admin\common\caching\facade\DevActionsCache;
use huikedev\dev_admin\common\model_trait\CreatorTrait;
use huikedev\dev_admin\service\system\support\exceptions\RebuildExceptionLang;
use huikedev\dev_admin\service\system\support\routes\RebuildRoutes;
use huikedev\huike_base\app_const\HuikeConfig;
use huikedev\huike_base\base\BaseModel;
use huikedev\huike_base\log\HuikeLog;
use huikedev\huike_base\utils\UtilsTools;
use think\helper\Str;
use think\Model;
use think\model\concern\SoftDelete;


/**
 * Class HuikeControllers
 *
 * @property int $id
 * @property string $controller_name 控制器标识
 * @property string $controller_title 控制器名称
 * @property int $path_id 上级目录ID
 * @property int $module_id 模块ID
 * @property string $route_name 路由标识
 * @property bool $is_static_service 静态服务代理模式
 * @property int $created_by_huike 是否为自动生成
 * @property string $exception_key 异常key
 * @property int $exception_code 异常code
 * @property string $exception_msg 异常message
 * @property int $creator_id 创建人ID
 * @property int $edit_level
 * @property int $delete_time 软删除时间
 * @property string $update_time 最后更新时间
 * @property string $create_time 创建时间
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeModules $module
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeControllers[] $controllers
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeActions[] $actions
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeControllers[] $children
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeControllers $path
 * @property-read mixed $path_name
 * @property-read mixed $service_file
 * @property-read mixed $service_class
 * @property-read mixed $logic_file
 * @property-read mixed $logic_class
 * @property-read mixed $validate_path
 * @property-read mixed $validate_namespace
 * @property-read mixed $facade_class
 * @property-read mixed $facade_file
 * @property-read mixed $relate_path
 * @property-read mixed $controller_class
 * @property-read mixed $provider_path
 * @property-read mixed $provider_namespace
 * @property-read mixed $exception_class
 * @property-read mixed $exception_file
 * @property-read mixed $creator
 */
class HuikeControllers extends BaseModel
{
    use CreatorTrait;
	// HuikeModelProperty
	use SoftDelete;
	protected $defaultSoftDelete = 0;
	protected $autoWriteTimestamp = true;
	protected $jsonAssoc = true;
	// HuikeModelPropertyEnd
    protected $type = [
      'is_static_service'=>  'boolean'
    ];

    public function module()
    {
        return $this->hasOne(HuikeModules::class,'id','module_id');
    }

    public function controllers()
    {
        return $this->hasMany(self::class,'path_id','id');
    }

    public function actions()
    {
        return $this->hasMany(HuikeActions::class,'controller_id','id');
    }

    public function children()
    {
        return $this->hasMany(self::class,'path_id','id');
    }

    public function path()
    {
        return $this->hasOne(self::class,'id','path_id');
    }

    // 目录名 如果是目录 返回common或目录名 如果是控制器 返回上级目录或common
    public function getPathNameAttr($value,$data)
    {
        if($data['path_id'] > 0){
            return $this->path->getAttr('path_name');
        }
        $path =  $data['controller_name'] === '/' ? 'common' : $data['controller_name'];
        return UtilsTools::replaceSeparator($path);
    }

    // 控制器service文件或目录 huikedev\dev_admin\src\service\dev\system\ControllersService.php or huikedev\dev_admin\src\service\dev\system
    public function getServiceFileAttr($value,$data):?string
    {
        if($data['path_id'] === 0){
            if(isset($this->module->id) === false){
                $this->module();
            }
            if($this->module->extend_module_id === 0){
                $path = $this->module->huike_path.DIRECTORY_SEPARATOR.$this->module->module_name.DIRECTORY_SEPARATOR.'service'.DIRECTORY_SEPARATOR;
            }else{
                $path = $this->module->huike_path.DIRECTORY_SEPARATOR.'service'.DIRECTORY_SEPARATOR;
            }

            $path .= DIRECTORY_SEPARATOR.$this->getAttr('path_name');
        }else{
            $path = $this->path->getAttr('service_file').DIRECTORY_SEPARATOR.Str::studly($data['controller_name']).'Service.php';
        }
        return UtilsTools::replaceSeparator($path);
    }
    // 带命名空间的服务类或目录的 huikedev\dev_admin\service\system\ControllersService
    public function getServiceClassAttr($value,$data): string
    {
        if($data['path_id'] === 0){
            if(isset($this->module->id) === false){
                $this->module();
            }
            if($this->module->extend_module_id === 0){
                $namespace = $this->module->huike_namespace.'\\'.$this->module->module_name.'\service\\'.$this->getAttr('path_name');
            }else{
                $namespace = $this->module->huike_namespace.'\service\\'.$this->getAttr('path_name');
            }

        }else{
            $namespace = $this->path->getAttr('service_class').'\\'.Str::studly($data['controller_name']).'Service';
        }
        return UtilsTools::replaceNamespace($namespace);
    }
    // 逻辑控制器文件或目录
    public function getLogicFileAttr($value,$data)
    {
        if($data['path_id'] === 0){
            if(isset($this->module->id) === false){
                $this->module();
            }
            if($this->module->extend_module_id === 0){
                $path = $this->module->huike_path.DIRECTORY_SEPARATOR.$this->module->module_name.DIRECTORY_SEPARATOR.'logic'.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$data['controller_name'];
            }else{
                $path = $this->module->huike_path.DIRECTORY_SEPARATOR.'logic'.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$data['controller_name'];
            }
        }else{
            $path = $this->path->getAttr('logic_file').DIRECTORY_SEPARATOR.Str::studly($data['controller_name']).'.php';
        }
        return UtilsTools::replaceSeparator($path);
    }
    // 带命名空间的逻辑控制器类名或目录
    public function getLogicClassAttr($value,$data): string
    {
        if($data['path_id'] === 0){
            if(isset($this->module->id) === false){
                $this->module();
            }
            if($this->module->extend_module_id === 0){
                $namespace = $this->module->huike_namespace.'\\'.$this->module->module_name.'\logic\controller\\'.$data['controller_name'];
            }else{
                $namespace = $this->module->huike_namespace.'\logic\controller\\'.$data['controller_name'];
            }
        }else{
            $namespace = $this->path->getAttr('logic_class').'\\'.Str::studly($data['controller_name']);
        }
        return UtilsTools::replaceNamespace($namespace);
    }

    // 逻辑控制器文件或目录
    public function getValidatePathAttr($value,$data)
    {
        if($data['path_id'] === 0){
            if(isset($this->module->id) === false){
                $this->module();
            }
            if($this->module->extend_module_id === 0){
                $path = $this->module->huike_path.DIRECTORY_SEPARATOR.$this->module->module_name.DIRECTORY_SEPARATOR.'validate'.DIRECTORY_SEPARATOR.$data['controller_name'];
            }else{
                $path = $this->module->huike_path.DIRECTORY_SEPARATOR.'validate'.DIRECTORY_SEPARATOR.$data['controller_name'];
            }
        }else{
            $path = $this->path->getAttr('validate_path').DIRECTORY_SEPARATOR.Str::snake($data['controller_name']);
        }
        return UtilsTools::replaceSeparator($path);
    }
    // 带命名空间的逻辑控制器类名或目录
    public function getValidateNamespaceAttr($value,$data): string
    {
        if($data['path_id'] === 0){
            if(isset($this->module->id) === false){
                $this->module();
            }
            if($this->module->extend_module_id === 0){
                $namespace = $this->module->huike_namespace.'\\'.$this->module->module_name.'\validate\\'.$data['controller_name'];
            }else{
                $namespace = $this->module->huike_namespace.'\validate\\'.$data['controller_name'];
            }
        }else{
            $namespace = $this->path->getAttr('validate_namespace').'\\'.Str::snake($data['controller_name']);
        }
        return UtilsTools::replaceNamespace($namespace);
    }

    // 门面类类名 huike\service\dev\user\facade\LoginService
    public function getFacadeClassAttr($value,$data): string
    {
        $serviceClass = $this->getAttr('service_class');
        $namespace = UtilsTools::getNamespacePrefix($serviceClass).'\\';
        $namespace .='facade\\'.Str::studly($data['controller_name'].'Service');
        return UtilsTools::replaceNamespace($namespace);
    }

    public function getFacadeFileAttr($value,$data): string
    {
        $serviceFile = $this->getAttr('service_file');
        $path =UtilsTools::getNamespacePrefix($serviceFile).DIRECTORY_SEPARATOR;
        $path .='facade'.DIRECTORY_SEPARATOR.Str::studly($data['controller_name'].'Service').'.php';
        return UtilsTools::replaceSeparator($path);
    }
    // 相对路径 dev\user\Login
    public function getRelatePathAttr($value,$data)
    {
        if(isset($this->module->id)){
            $this->module();
        }
        $path = $this->module->module_name.'\\';
        if($data['path_id'] === 0){
            $path .=$data['controller_name'];
        }else{
            if(isset($this->path->id)){
                $this->path();
            }
            $path .=$this->path->controller_name.'\\'.$data['controller_name'];
        }
        return UtilsTools::replaceSeparator($path);
    }
    // 控制器类名称 app\controller\dev\user\Login
    public function getControllerClassAttr($value,$data): string
    {
        $fullClassName = app()->getNamespace().'\\controller\\'.$this->getAttr('relate_path');
        return UtilsTools::replaceNamespace($fullClassName);
    }
    // provider 路径
    public function getProviderPathAttr($value,$data):string
    {
        $serviceFile = $this->getAttr('service_file');
        $path =UtilsTools::getNamespacePrefix($serviceFile).DIRECTORY_SEPARATOR;
        if($data['path_id'] === 0){
           return  UtilsTools::replaceSeparator($path);
        }

        $path .='provider'.DIRECTORY_SEPARATOR.Str::snake($data['controller_name']);

        return  UtilsTools::replaceSeparator($path);
    }

    public function getProviderNamespaceAttr($value,$data):string
    {
        $serviceClass = $this->getAttr('service_class');
        $namespace = UtilsTools::getNamespacePrefix($serviceClass);
        if($data['path_id'] === 0){
            return  UtilsTools::replaceNamespace($namespace);
        }

        $namespace .='\provider\\'.Str::snake($data['controller_name']);

        return  UtilsTools::replaceNamespace($namespace);
    }

    public function getExceptionClassAttr($value,$data): string
    {
        $serviceClass = $this->getAttr('service_class');
        $namespace = UtilsTools::getNamespacePrefix($serviceClass);
        $namespace .='\\exception\\';
        if($data['path_id'] === 0){
            return  UtilsTools::replaceNamespace($namespace);
        }
        $namespace .=Str::studly($data['controller_name']).'ServiceException';
        return UtilsTools::replaceNamespace($namespace);
    }

    public function getExceptionFileAttr($value,$data)
    {
        $serviceFile = $this->getAttr('service_file');
        $path =UtilsTools::getNamespacePrefix($serviceFile).DIRECTORY_SEPARATOR.'exception';
        if($data['path_id'] === 0){
            return  UtilsTools::replaceSeparator($path);
        }
        $path .=DIRECTORY_SEPARATOR.Str::studly($data['controller_name']).'ServiceException'.'.php';
        return UtilsTools::replaceSeparator($path);
    }

    public static function onAfterWrite(Model $model): void
    {
        try {
            if($model->module_id > 1) {
                (new RebuildRoutes())->setModuleId($model->module_id)->handle();
                (new RebuildExceptionLang())->handle($model->module_id);
                DevActionsCache::deleteCache();
            }
        }catch (\Throwable $e){
            HuikeLog::error($e);
        }
    }

    public static function onAfterDelete(Model $model): void
    {
        try {
            if($model->module_id > 1){
                (new RebuildRoutes())->setModuleId($model->module_id)->handle();
                (new RebuildExceptionLang())->handle($model->module_id);
                DevActionsCache::deleteCache();
            }
        }catch (\Throwable $e){
            HuikeLog::error($e);
        }
    }


// GENERATED END
}