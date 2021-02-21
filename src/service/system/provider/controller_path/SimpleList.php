<?php

namespace huikedev\dev_admin\service\system\provider\controller_path;



use huikedev\dev_admin\common\model\huike\HuikeControllers;

class SimpleList
{
    

	 /**
	 * @desc 简单列表
	 * @huike handler
	 * @return array
	 */
	public function handle():array
	{
        return  HuikeControllers::field(['id','controller_name','module_id','route_name','controller_title'])->where('path_id','=',0)->select()->toArray();
	}

}