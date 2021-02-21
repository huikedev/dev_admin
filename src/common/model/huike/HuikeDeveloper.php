<?php


namespace huikedev\dev_admin\common\model\huike;

use huikedev\dev_admin\common\model_trait\CreatorTrait;
use huikedev\huike_base\base\BaseModel;
use think\facade\Config;
use think\model\concern\SoftDelete;

/**
 * Class HuikeDeveloper
 *
 * @property string $cellphone 手机号码
 * @property int $id
 * @property string $username 用户名
 * @property string $password 登录密码
 * @property int $position_id 职位ID
 * @property string $last_login_ip 上次登录IP
 * @property int $login_time 当次登录时间
 * @property string $login_ip 当次登录IP
 * @property int $last_login_time 最后登录时间
 * @property int $creator_id
 * @property int $delete_time 删除时间
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 * @property-read mixed $position_text
 * @property-read mixed $creator
 */
class HuikeDeveloper extends BaseModel
{
    use SoftDelete;
    use CreatorTrait;
    protected $defaultSoftDelete=0;

    public static $hiddenFields=[
        'password','delete_time','create_time','update_time'
    ];

    public function getPositionTextAttr($value,$data): string
    {
        $positions = Config::get('huike_dev_admin.positions',[]);
        $position = array_filter($positions,function ($item)use ($data){
            return $item['id'] == $data['position_id'];
        });
        return count($position)> 0 ? current($position)['title'] : '未知岗位';
    }
}