<?php


namespace huikedev\dev_admin\common\model\huike;


use huikedev\huike_base\base\BaseModel;
use huikedev\huike_base\utils\UtilsTools;

/**
 * Class HuikeExtendModules
 *
 * @property int $id
 * @property string $root_path 模块根目录
 * @property string $root_namespace 根命名空间
 * @property string $root_base_exception 模块异常基类
 * @property string $root_base_model 模块模型基类
 * @property string $root_base_controller 模块控制器基类
 * @property string $root_base_logic 模块控制器基类
 */
class HuikeExtendModules extends BaseModel
{
    protected $autoWriteTimestamp = false;

    public function getRootPathAttr($value)
    {
        return UtilsTools::replaceSeparator($value);
    }
}