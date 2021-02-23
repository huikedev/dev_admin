<?php

use think\migration\Seeder;

class HuikeExtendModulesHbsfon extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {


		// id = 1
		think\facade\Db::table('huike_extend_modules')->insert(['id' => 1,'root_path' => 'huikedev\dev_admin\src','root_namespace' => 'huikedev\dev_admin','root_base_exception' => 'huikedev\dev_admin\common\exception\DevServiceException','root_base_model' => 'huikedev\dev_admin\common\DevModel','root_base_controller' => 'huikedev\dev_admin\common\DevController']);
}
}