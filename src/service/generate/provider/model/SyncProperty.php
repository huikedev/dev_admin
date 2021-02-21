<?php


namespace huikedev\dev_admin\service\generate\provider\model;


use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeModels;
use huikedev\dev_admin\service\generate\exception\ModelServiceException;
use ReflectionClass;
use think\model\concern\SoftDelete;

class SyncProperty
{
    /**
     * @var ReflectionClass
     */
    protected $modelReflection;
    /**
     * @var HuikeModels
     */
    protected $model;
    /**
     * @var array
     */
    protected $defaultProperties;
    public function handle()
    {
        $this->model = HuikeModels::where('id','=',AppRequest::id())->findOrEmpty();
        if($this->model->isEmpty()){
            throw new ModelServiceException('未找到ID为【'.AppRequest::id().'】的模型',71);
        }

        try {
            $this->modelReflection = new ReflectionClass($this->model->model_full_name);
        }catch (\Exception $e){
            throw new ModelServiceException($e->getMessage(),72);
        }
        $this->defaultProperties = $this->modelReflection->getDefaultProperties();
        $this->getTableName();
        $this->getPkName();
        $this->getConnectionName();
        $this->getIsJsonAssoc();
        $this->getIsDeleteTime();
        $this->getIsUpdateTime();
        $this->getIsCreateTime();
        $this->model->save();
        return true;
    }

    protected function getTableName():void
    {
        $this->model->table_name = $this->defaultProperties['table'] ?? '';
    }

    protected function getPkName():void
    {
        $pk = $this->defaultProperties['pk'] ?? 'id';
        $this->model->pk_name = $pk === 'id' ? '' : $pk;
    }

    protected function getConnectionName():void
    {
        $this->model->connection_name = $this->defaultProperties['table'] ?? '';
    }

    protected function getIsJsonAssoc():void
    {
        $this->model->is_json_assoc = isset($this->defaultProperties['jsonAssoc']) && $this->defaultProperties['jsonAssoc'] ? 1 : 0;
    }

    protected function getIsDeleteTime():void
    {
        $traits = $this->modelReflection->getTraits();
        $this->model->is_delete_time = intval(isset($traits[SoftDelete::class]));
    }

    protected function getIsUpdateTime():void
    {
        $isAutoTimestamp = $this->defaultProperties['autoWriteTimestamp'] ?? false;
        $updateTime = $this->defaultProperties['updateTime'] ?? false;
        $this->model->is_update_time = intval($isAutoTimestamp && $updateTime);
    }

    protected function getIsCreateTime():void
    {
        $isAutoTimestamp = $this->defaultProperties['autoWriteTimestamp'] ?? false;
        $createTime = $this->defaultProperties['createTime'] ?? false;
        $this->model->is_create_time = intval($isAutoTimestamp && $createTime);
    }
}