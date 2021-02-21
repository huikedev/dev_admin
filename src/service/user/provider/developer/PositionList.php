<?php

namespace huikedev\dev_admin\service\user\provider\developer;



use think\facade\Config;

class PositionList
{
    

	 /**
	 * @desc 岗位列表
	 * @huike handler
	 * @return array
	 */
	public function handle():array
	{
		return Config::get('huike_dev_admin.positions',[]);
	}

}