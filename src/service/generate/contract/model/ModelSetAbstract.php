<?php


namespace huikedev\dev_admin\service\generate\contract\model;


use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\huike_base\interceptor\auth\facade\Auth;
use huikedev\huike_base\utils\UtilsTools;
use think\helper\Str;

abstract class ModelSetAbstract
{
    /**
     * @var HuikeModules
     */
    protected $module;
    protected $moduleId;
    // 模型类名
    protected $modelClassName;
    // 可能存在的模型命名空间前缀
    protected $modelNamespacePrefix;
    // 模型备注信息
    protected $modelRemark;
    // 包含命名空间的模型类名
    protected $modelFullName;
    protected $addonFields;
    protected $primary;
    protected $baseModelId;
    protected $modelExtend;
    protected $modelFile;
    /**
     * @var HuikeModels
     */
    protected $modelConfig;

    public function __construct()
    {
        $this->parseModelName();
        $this->parseBaseModel();
        $this->addonFields = AppRequest::safeArray('addon_fields');
        $this->primary = AppRequest::has('pk_name') ? AppRequest::param('pk_name', 'id') :'id';
        if (AppRequest::id() === 0) {
            $this->modelConfig = HuikeModels::where('model_full_name', '=', $this->modelFullName)->findOrEmpty();
        } else {
            $this->modelConfig = HuikeModels::where('id', '=', AppRequest::id())->findOrEmpty();
        }
    }

    protected function setModel()
    {
        $this->modelConfig->model_name = $this->modelClassName;
        $this->modelConfig->model_full_name = $this->modelFullName;
        $this->modelConfig->base_model_id = $this->baseModelId;
        $this->modelConfig->module_id = $this->moduleId;
        $this->modelConfig->is_json_assoc = intval(AppRequest::safeBoolean('is_json_assoc'));
        if (empty(AppRequest::safeString('model_table')) === false) {
            $this->modelConfig->table_name = AppRequest::safeString('model_table');
        }
        if (empty(AppRequest::safeString('model_connection')) === false) {
            $this->modelConfig->connection_name = AppRequest::safeString('model_connection');
        }
        if (empty(AppRequest::safeString('remark')) === false) {
            $this->modelConfig->remark = AppRequest::safeString('remark');
        }
        if ($this->primary !== 'id') {
            $this->modelConfig->pk_name = $this->primary;
        }
        $this->modelConfig->creator_id = Auth::getUserId();
        $this->modelConfig->is_delete_time = intval(in_array('delete_time', $this->addonFields));
        $this->modelConfig->is_update_time = intval(in_array('update_time', $this->addonFields));
        $this->modelConfig->is_create_time = intval(in_array('create_time', $this->addonFields));
        $this->modelConfig->is_creator_id = intval(in_array('creator_id', $this->addonFields));
        $this->modelConfig->save();
    }

    protected function parseModelName()
    {
        $modelName = UtilsTools::replaceNamespace(AppRequest::safeString('model_name'));
        $modelNameArray = explode('\\', $modelName);
        $this->modelClassName = Str::studly(array_pop($modelNameArray));
        $this->modelNamespacePrefix = implode('\\', $modelNameArray);
        $this->moduleId = AppRequest::safeInteger('module_id');
        if($this->moduleId > 0){
            $this->module = HuikeModules::where('id','=',$this->moduleId)->findOrEmpty();
            $huikeNamespace = $this->module->huike_namespace;
            $huikePath = $this->module->huike_path;
        }else{
            $huikeNamespace = 'huike';
            $huikePath = 'huike';
        }
        if(empty($this->modelNamespacePrefix)){
            $this->modelFullName = $huikeNamespace.'\common\model\\'.$this->modelClassName;
            $this->modelFile = UtilsTools::replaceSeparator(app()->getRootPath().$huikePath.'\common\model\\'.$this->modelClassName).'.php';
        }else{
            $this->modelFullName = $huikeNamespace.'\common\model\\'.$this->modelNamespacePrefix.'\\'.$this->modelClassName;
            $this->modelFile = UtilsTools::replaceSeparator(app()->getRootPath().$huikePath.'\common\model\\'.$this->modelNamespacePrefix.'\\'.$this->modelClassName).'.php';
        }
        if (AppRequest::has('model_remark')) {
            $this->modelRemark = AppRequest::safeString('model_remark');
        }
    }

    protected function parseBaseModel()
    {
        $this->baseModelId = AppRequest::safeInteger('base_model_id');
        switch ($this->baseModelId){
            case 0:
                $this->modelExtend = 'think\\Model';
                break;
            case 1:
                $this->modelExtend = 'huikedev\\huike_base\\base\\BaseModel';
                break;
            default:
                if(isset($this->module->extend_module->root_base_model) && empty($this->module->extend_module->root_base_model)===false){
                    $this->modelExtend = $this->module->extend_module->root_base_model;
                }else{
                    $this->modelExtend = 'huikedev\\huike_base\\base\\BaseModel';
                }
        }
    }
}