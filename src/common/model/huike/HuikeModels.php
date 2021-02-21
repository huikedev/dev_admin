<?php


namespace huikedev\dev_admin\common\model\huike;


use huikedev\dev_admin\common\model_trait\CreatorTrait;
use huikedev\huike_base\base\BaseModel;
use huikedev\huike_base\utils\UtilsTools;
use think\facade\Config;
use think\helper\Str;
use think\model\concern\SoftDelete;

/**
 * Class HuikeModels
 *
 * @property string $model_path 模型路径
 * @property string $model_namespace 模型路径
 * @property mixed $model_property 模型属性
 * @property mixed $model_relations 模型关联
 * @property int $json_assoc
 * @property int $id
 * @property string $model_name 模型名称
 * @property string $model_full_name 模型全名
 * @property int $module_id 模块ID
 * @property int $base_model_id 模型基类0=think\Model 1=huike\base\Model 2=第三方模块模型基类
 * @property string $table_name 模型对应的表名称
 * @property string $pk_name 主键名称
 * @property string $connection_name 数据库连接名称
 * @property string $remark
 * @property int $is_json_assoc
 * @property int $is_delete_time 是否包含软删除时间字段
 * @property int $is_create_time 是否包含创建时间字段
 * @property int $is_update_time 是否包含更新时间字段
 * @property int $is_creator_id 是否包含创建人字段
 * @property string $migrate_version 数据库迁移版本
 * @property string $migrate_file 数据库迁移文件
 * @property string $seed_file 数据库种子文件
 * @property int $creator_id 创建人ID
 * @property int $delete_time 标记删除
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 * @property-read mixed $real_table_name
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeModules $module
 * @property-read mixed $real_connection_name
 * @property-read mixed $model_extend_text
 * @property-read mixed $migration_path
 * @property-read mixed $seeds_path
 * @property-read mixed $short_migrate_file
 * @property-read mixed $creator
 */
class HuikeModels extends BaseModel
{
    use CreatorTrait;
    use SoftDelete;

    protected $jsonAssoc=true;
    protected $json=['model_fields','model_property','model_relations'];


    public function getRealTableNameAttr($value,$data)
    {
        $connection = isset($data['connection_name']) && empty($data['connection_name']) === false ? $data['connection_name'] : Config::get('database.default');
        $connectionConfig = Config::get('database.connections.'.$connection);
        $tableName = $connectionConfig['prefix'] ?? '';
        if(isset($data['table_name']) && empty($data['table_name'])===false){
            return $tableName.Str::snake($data['table_name']);
        }else{
            return $tableName.Str::snake($data['model_name']);
        }
    }

    public function module()
    {
        return $this->hasOne(HuikeModules::class,'id','module_id');
    }

    public function getRealConnectionNameAttr($value,$data)
    {
        return isset($data['connection_name']) && empty($data['connection_name']) === false ? $data['connection_name'] : Config::get('database.default');
    }

    public function getModelExtendTextAttr($value,$data): string
    {
        if($data['base_model_id']===0){
            return 'think\\Model';
        }
        if($data['base_model_id']===1){
            return 'huikedev\\huike_base\\base\\BaseModel';
        }
        if(isset($this->module) === false){
            $this->module();
        }
        if(isset($this->module->extend_module->root_base_model) && empty($this->module->extend_module->root_base_model)===false){
            return $this->module->extend_module->root_base_model;
        }else{
            return 'huikedev\\huike_base\\base\\BaseModel';
        }
    }

    public function getMigrationPathAttr($value,$data)
    {
        if($data['module_id'] === 0){
            return app()->getRootPath();
        }else{
            if(isset($this->module) === false){
                $this->module();
            }
            return UtilsTools::replaceSeparator(app()->getRootPath().$this->module->extend_module->root_path);
        }
    }

    public function getSeedsPathAttr($value,$data)
    {
        if($data['module_id'] === 0){
            return app()->getRootPath();
        }else{
            if(isset($this->module) === false){
                $this->module();
            }
            return UtilsTools::replaceSeparator(app()->getRootPath().$this->module->extend_module->root_path);
        }
    }

    public function getShortMigrateFileAttr($value,$data)
    {
        if(empty($data['migrate_file'])){
            return '';
        }else{
            return pathinfo($data['migrate_file'],PATHINFO_FILENAME);
        }
    }
}