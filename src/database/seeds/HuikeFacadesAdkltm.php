<?php

use think\migration\Seeder;

class HuikeFacadesAdkltm extends Seeder
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
		think\facade\Db::table('huike_facades')->insert(['id' => 1,'origin_class' => 'huikedev\dev_admin\common\caching\provider\routes\DevActionsCache','facade_class' => 'huikedev\dev_admin\common\caching\facade\DevActionsCache','facade_path' => 'huikedev\dev_admin\src\common\caching\facade','facade_title' => '路由方法缓存','type_id' => 3,'action_count' => 8,'update_times' => 5,'creator_id' => 1,'edit_level' => 21,'create_time' => 1613731609,'update_time' => 1614080744]);
		// id = 2
		think\facade\Db::table('huike_facades')->insert(['id' => 2,'origin_class' => 'huikedev\dev_admin\common\caching\provider\user\DeveloperCache','facade_class' => 'huikedev\dev_admin\common\caching\facade\DeveloperCache','facade_path' => 'huikedev\dev_admin\src\common\caching\facade','facade_title' => '开发者信息','type_id' => 3,'action_count' => 8,'update_times' => 2,'creator_id' => 1,'edit_level' => 21,'create_time' => 1613731764,'update_time' => 1614080525]);
}
}