<?php

namespace huikedev\dev_admin\common\caching\provider\user;

use huikedev\dev_admin\common\caching\support\DevCachePrefix;
use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use huikedev\huike_base\base\caching\AppCachingAbstract;

class DeveloperCache extends AppCachingAbstract
{
    /**
     * @var HuikeDeveloper
     */
    protected $model;
    protected function setPrefix()
    {
        $this->prefix = DevCachePrefix::DEV_DEVELOPER;
    }

    public function getId():int
    {
        $this->parseDataToModel();
        return $this->model->id ?? 0;
    }

    public function getModel():HuikeDeveloper
    {
        $this->parseDataToModel();
        return $this->model;
    }

    // 对于模型或数据集的操作都应该将数组注入到对应的模型来获得模型实例
    protected function parseDataToModel()
    {

        // 判断是否需要从redis中获取数据
        if(is_null($this->model) === false && $this->update === false){
            return $this;
        }
        $this->getCacheData();
        if(empty($this->cacheData)){
            $this->model =  new HuikeDeveloper([]);
        }else{
            $this->model = new HuikeDeveloper($this->cacheData);
        }
        return $this;
    }

    protected function getDataSource()
    {
        // 注意所有的模型最后都应该toArray，将模型实例转换为数组存入redis以节省redis内存
        // 在取出的时候 通过逻辑将data注入到对应的模型/数据集实例已获得模型方法
        return HuikeDeveloper::where('id','=',$this->id)->findOrEmpty()->toArray();
    }
}