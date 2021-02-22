<?php

namespace huikedev\dev_admin\common\model\huike;

use huikedev\dev_admin\common\caching\facade\DevActionsCache;
use huikedev\dev_admin\common\model_trait\CreatorTrait;
use huikedev\dev_admin\service\system\support\exceptions\RebuildExceptionLang;
use huikedev\dev_admin\service\system\support\routes\RebuildRoutes;
use huikedev\huike_base\base\BaseModel;
use huikedev\huike_base\log\HuikeLog;
use huikedev\huike_base\utils\UtilsTools;
use think\Model;
use think\model\concern\SoftDelete;


/**
 * Class HuikeModules
 *
 * @property string $root_namespace 根命名空间
 * @property string $root_path 根目录
 * @property-read mixed $namespace
 * @property-read mixed $path
 * @property int $id
 * @property string $module_name 模块名称（英文），即目录名称
 * @property string $module_title 模块名称（中文）
 * @property string $route_name 路由名称（英文）
 * @property mixed $route_middleware 路由中间件
 * @property mixed $bind_domain 绑定域名
 * @property int $extend_module_id 第三方模块扩展ID
 * @property int $creator_id 创建人ID
 * @property string $create_time 创建时间
 * @property string $update_time 最后更新时间
 * @property int $delete_time 软删除时间
 * @property-read mixed $full_path
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeControllers[] $controllers
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeExtendModules $extend_module
 * @property-read mixed $huike_namespace
 * @property-read mixed $huike_path
 * @property-read mixed $creator
 */
class HuikeModules extends BaseModel
{
    use CreatorTrait;
	// HuikeModelProperty
	use SoftDelete;
	protected $defaultSoftDelete = 0;
	protected $autoWriteTimestamp = true;
    protected $jsonAssoc = true;
    protected $json = ['route_middleware','bind_domain'];
	// HuikeModelPropertyEnd

    public function getFullPathAttr($value,$data)
    {
        return app()->getAppPath().'controller'.DIRECTORY_SEPARATOR.$data['module_name'];
    }

    public function controllers(): \think\model\relation\HasMany
    {
        return $this->hasMany(HuikeControllers::class,'module_id','id');
    }

    public function extendModule(): \think\model\relation\HasOne
    {
        return $this->hasOne(HuikeExtendModules::class,'id','extend_module_id');
    }

    public function getHuikeNamespaceAttr($value,$data): string
    {
        if(isset($data['extend_module_id'])===false || $data['extend_module_id']===0){
            return 'huike';
        }else{
            if(isset($this->extend_module->id)===false){
                $this->extendModule();
            }
            return UtilsTools::replaceSeparator(str_replace(app()->getRootPath(),'',$this->extend_module->root_namespace));
        }
    }

    public function getHuikePathAttr($value,$data)
    {
        if(isset($data['extend_module_id'])===false || $data['extend_module_id']===0){
            return 'huike';
        }else{
            if(isset($this->extend_module->id)===false){
                $this->extendModule();
            }
            return UtilsTools::replaceSeparator(str_replace(app()->getRootPath(),'',$this->extend_module->root_path));
        }
    }

    public static function onAfterWrite(Model $model): void
    {
        try {
            (new RebuildRoutes())->setModuleId($model->id)->handle();
            (new RebuildExceptionLang())->handle($model->id);
            DevActionsCache::deleteCache();
        }catch (\Throwable $e){
            HuikeLog::error($e);
        }
    }

    public static function onAfterDelete(Model $model): void
    {
        try {
            (new RebuildRoutes())->setModuleId($model->id)->handle();
            (new RebuildExceptionLang())->handle($model->id);
            DevActionsCache::deleteCache();
        }catch (\Throwable $e){
            HuikeLog::error($e);
        }
    }

// GENERATED END
}