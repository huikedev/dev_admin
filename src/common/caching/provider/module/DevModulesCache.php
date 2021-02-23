<?php


namespace huikedev\dev_admin\common\caching\provider\module;


use huikedev\dev_admin\common\caching\support\DevCachePrefix;
use huikedev\dev_admin\common\model\huike\HuikeExtendModules;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\base\caching\AppSettingCacheAbstract;
use think\model\Collection;

class DevModulesCache extends AppSettingCacheAbstract
{
    /**
     * @var Collection
     */
    protected $collection;
    protected function setPrefix()
    {
        $this->prefix = DevCachePrefix::DEV_MODULES;
    }

    public function getModel(int $id)
    {
        $this->parseDataToCollection();
        return $this->collection->where('id','=',$id)->first();
    }

    protected function parseDataToCollection()
    {
        if(is_null($this->collection) === false && $this->update === false){
            return $this;
        }
        $this->getCacheData();
        $this->parseData();
        return $this;
    }

    protected function parseData()
    {
        $this->collection = new Collection();
        foreach ($this->cacheData as $module){

            if(isset($module['extend_module']) && empty($module['extend_module']) === false){
                $extendModuleData = $module['extend_module'];
                unset($module['extend_module']);
            }else{
                $extendModuleData = [];
            }

            $moduleModel = new HuikeModules($module);
            $moduleModel->setRelation('extend_module',new HuikeExtendModules($extendModuleData));
            $this->collection->push($moduleModel);
        }
    }

    protected function getDataSource()
    {
        return HuikeModules::with(['extend_module'])->select()->toArray();
    }
}