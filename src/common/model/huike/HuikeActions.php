<?php

namespace huikedev\dev_admin\common\model\huike;

use huikedev\dev_admin\common\caching\facade\DevActionsCache;
use huikedev\dev_admin\common\model_trait\CreatorTrait;
use huikedev\dev_admin\service\system\support\routes\RebuildRoutes;
use huikedev\huike_base\app_const\HuikeConfig;
use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\app_const\RequestMethods;
use huikedev\huike_base\app_const\response\AppResponseType;
use huikedev\huike_base\app_const\ServiceReturnType;
use huikedev\huike_base\base\BaseModel;
use huikedev\huike_base\log\HuikeLog;
use think\helper\Str;
use think\Model;
use think\model\concern\SoftDelete;



/**
 * Class HuikeActions
 *
 * @property int $id
 * @property string $action_name 方法名
 * @property string $action_title 方法名称
 * @property int $controller_id 控制器ID
 * @property string $route_name 路由别名
 * @property int $request_method 请求类型
 * @property string $service_return_type 返回类型
 * @property bool $is_need_permission 是否需要权限
 * @property int $notice_type 前端操作反馈
 * @property int $response_type 响应类型
 * @property string $remind_msg 提示消息
 * @property bool $is_private 是否公开访问
 * @property string $remark 备注
 * @property int $creator_id 创建人ID
 * @property string $create_time 创建时间
 * @property string $update_time 最后更新时间
 * @property int $delete_time 软删除时间
 * @property-read \huikedev\dev_admin\common\model\huike\HuikeControllers $controller
 * @property-read string $request_method_text
 * @property-read string $notice_type_text
 * @property-read string $response_type_text
 * @property-read string $service_return_type_text
 * @property-read mixed $action_service_class
 */
class HuikeActions extends BaseModel
{
    use CreatorTrait;
	// HuikeModelProperty
	use SoftDelete;
	protected $defaultSoftDelete = 0;
	protected $autoWriteTimestamp = true;
	protected $jsonAssoc=true;
	// HuikeModelPropertyEnd


    public static $commonAppends = [
        'request_method_text','notice_type_text','response_type_text','service_return_type_text','creator'
    ];

    protected $type = [
        'is_private'       => 'boolean',
        'is_need_permission'       => 'boolean',
    ];

    public function controller()
    {
        return $this->hasOne(HuikeControllers::class,'id','controller_id');
    }

    /**
     * @desc 请求方式获取器
     * @param $value
     * @param $data
     * @return string
     */
    public function getRequestMethodTextAttr($value,$data): string
    {
        return RequestMethods::METHODS[$data['request_method']] ?? '未知';
    }

    /**
     * @desc 前端操作反馈获取器
     * @param $value
     * @param $data
     * @return string
     */
    public function getNoticeTypeTextAttr($value,$data): string
    {
        return NoticeType::ALL_TEXT[$data['notice_type']] ?? '未知';
    }

    /**
     * @desc 响应类型获取器
     * @param $value
     * @param $data
     * @return string
     */
    public function getResponseTypeTextAttr($value,$data): string
    {
        return AppResponseType::ALL_TEXT[$data['response_type']] ?? '未知';
    }

    /**
     * @desc service返回类型获取器
     * @param $value
     * @param $data
     * @return string
     */
    public function getServiceReturnTypeTextAttr($value,$data): string
    {
        return ServiceReturnType::ALL_TEXT[$data['service_return_type']] ?? '自定义（object）';
    }

    public function getActionServiceClassAttr($value,$data)
    {
        if(isset($this->controller)===false){
            $this->controller();
        }
        return $this->controller->service_class;
    }

    public function getServiceHandlerAttr($value,$data): string
    {
        if(isset($this->controller)===false){
            $this->controller();
        }
        return $this->controller->provider_namespace.'\\'.Str::studly($data['action_name']);
    }

    public static function onAfterWrite(Model $model): void
    {
        try {
            DevActionsCache::deleteCache();
            (new RebuildRoutes())->setControllerId($model->controller_id)->handle();
        }catch (\Throwable $e){
            HuikeLog::error($e);
        }
    }

    public static function onAfterDelete(Model $model): void
    {
        try {
            DevActionsCache::deleteCache();
            (new RebuildRoutes())->setControllerId($model->controller_id)->handle();
        }catch (\Throwable $e){
            HuikeLog::error($e);
        }
    }


// GENERATED END
}