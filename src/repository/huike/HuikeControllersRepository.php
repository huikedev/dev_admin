<?php


namespace huikedev\dev_admin\repository\huike;


use huikedev\dev_admin\common\model\huike\HuikeActions;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_base\base\BaseRepository;
use huikedev\huike_base\facade\AppRequest;
use think\Exception;
use think\Paginator;

// 此逻辑仅为一种尝试 如果需要对模型操作规范到极致，防止犯一些低级错误的话，可以在service与model中间再增加一层Repository
// 用于规范Model操作。同时还可以对数据进行再次封装。但进行这些操作会付出非常多的精力，所以这里仅仅是进行了尝试，个人不推荐
// 使用Repository的架构。本身模型的能力已经足够强大了。
class HuikeControllersRepository extends BaseRepository
{
    protected $model = HuikeControllers::class;
    /**
     * @var HuikeControllers
     */
    protected $instance;
    protected function getNewQuery()
    {
        return HuikeControllers::newQuery();
    }

    protected function setInstance()
    {
        $this->instance = HuikeControllers::field('*');
    }

    /**
     * @desc 控制器列表数据 @前端 系统设置-逻辑管理-控制器管理
     * @param int $moduleId
     * @return Paginator
     * @throws \think\db\exception\DbException
     */
    public function indexPaginate(int $moduleId = 0):Paginator
    {
        $this->instance->with(['module','path'])->where('path_id','>',0);
        if($moduleId > 0){
            $this->instance->where('module_id','=',$moduleId);
        }
        return $this->instance->modelSort('update_time.desc')->append(['service_class','creator','actions'=>HuikeActions::$commonAppends])->paginate(AppRequest::pageSize());
    }



    public function hasWhereModule(int $moduleId)
    {
        if($this->hasWhereCount > 0){
            throw new Exception('模型hasWhere方法仅可使用一次');
        }
        $this->instance = $this->getNewQuery()->hasWhere('module',[['id','=',$moduleId]]);
        $this->hasWhereCount++;
        return $this;
    }

}