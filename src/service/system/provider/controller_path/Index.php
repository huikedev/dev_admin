<?php

namespace huikedev\dev_admin\service\system\provider\controller_path;

use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\huike_base\facade\AppRequest;
use think\Paginator;


class Index
{


    /**
     * @desc 首页 首页
     * @huike handler
     * @return Paginator
     * @throws \think\db\exception\DbException
     */
	public function handle():Paginator
	{
		$model = HuikeControllers::with(['module','controllers'])->where('path_id','=',0)->modelSort('update_time.desc');
		if(AppRequest::has('module_id')){
            $model->where('module_id','=',AppRequest::safeInteger('module_id'));
        }
        return $model->append(['creator'])->paginate(AppRequest::pageSize());


	}

}