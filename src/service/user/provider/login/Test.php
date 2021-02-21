<?php

namespace huikedev\dev_admin\service\user\provider\login;



use huikedev\dev_admin\common\model\huike\HuikeControllers;

class Test
{
    

	 /**
	 * @desc 测试
	 * @huike handler
	 * @return mixed
	 */
	public function handle()
	{
        $res = HuikeControllers::where('id','=',10)->find();
        return $res->id;
	}

}