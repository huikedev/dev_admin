<?php

namespace huikedev\dev_admin\service\user\provider\developer;

use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use think\Paginator;


class Index
{
    

	 /**
	 * @desc 列表
	 * @huike handler
	 * @return Paginator
	 */
	public function handle():Paginator
	{
		$model = HuikeDeveloper::modelSort()->append(['position_text','creator'])->hidden(['password'])->paginate();
		return $model;
	}

}