<?php

use think\migration\Seeder;

class HuikeModulesUfxkbg extends Seeder
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
		think\facade\Db::table('huike_modules')->json(['route_middleware','bind_domain'])->insert(['id' => 1,'module_name' => 'dev','module_title' => '开发辅助','route_name' => 'dev','route_middleware' => [		'huikedev\dev_admin\common\middlewares\DevRouteMiddleware'],'bind_domain' => [		'core.local'],'extend_module_id' => 3,'creator_id' => 1,'create_time' => 1612095224,'update_time' => 1612095224]);
}
}