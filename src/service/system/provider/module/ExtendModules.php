<?php

namespace huikedev\dev_admin\service\system\provider\module;


use huikedev\dev_admin\common\model\huike\HuikeModules;

class ExtendModules
{
    

	 /**
	 * @desc 第三方模块列表
	 * @huike handler
	 * @return array
	 */
	public function handle():array
	{
		$moduleList = HuikeModules::with(['extend_module'])->where('extend_module_id','>',0)->select();
		return $moduleList->toArray();
	}

}