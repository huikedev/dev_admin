<?php


namespace huikedev\dev_admin\common\model\huike;


use huikedev\dev_admin\common\model_trait\CreatorTrait;
use huikedev\huike_base\base\BaseModel;
use think\model\concern\SoftDelete;

/**
 * Class HuikeFacades
 *
 * @property int $id
 * @property string $origin_class 原始类名称
 * @property string $facade_class 门面类名称
 * @property string $origin_path 原始类路径
 * @property string $facade_path 门面类路径
 * @property int $type_id 门面类型
 * @property int $update_times 更新次数
 * @property int $delete_time 标记删除
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class HuikeFacades extends BaseModel
{
    use CreatorTrait;
    use SoftDelete;

    public function getShortFacadeClassAttr($value,$data)
    {
        return pathinfo($data['facade_class'],PATHINFO_FILENAME);
    }

    public function getShortOriginClassAttr($value,$data)
    {
        return pathinfo($data['origin_class'],PATHINFO_FILENAME);
    }
}