<?php

use think\migration\Seeder;

class HuikeControllersKheain extends Seeder
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
		think\facade\Db::table('huike_controllers')->insert(['id' => 1,'controller_name' => '/','controller_title' => '模块根目录','module_id' => 1,'created_by_huike' => 1,'creator_id' => 1,'update_time' => 1612095224,'create_time' => 1612095224]);
		// id = 2
		think\facade\Db::table('huike_controllers')->insert(['id' => 2,'controller_name' => 'generate','controller_title' => '代码生成','module_id' => 1,'route_name' => 'generate','created_by_huike' => 1,'creator_id' => 1,'update_time' => 1613885227,'create_time' => 1612102562]);
		// id = 3
		think\facade\Db::table('huike_controllers')->insert(['id' => 3,'controller_name' => 'system','controller_title' => '系统设置','module_id' => 1,'route_name' => 'system','created_by_huike' => 1,'creator_id' => 1,'update_time' => 1612102659,'create_time' => 1612102659]);
		// id = 4
		think\facade\Db::table('huike_controllers')->insert(['id' => 4,'controller_name' => 'user','controller_title' => '管理用户','module_id' => 1,'created_by_huike' => 1,'creator_id' => 1,'update_time' => 1612102673,'create_time' => 1612102673]);
		// id = 5
		think\facade\Db::table('huike_controllers')->insert(['id' => 5,'controller_name' => 'Login','controller_title' => '登录','path_id' => 4,'module_id' => 1,'route_name' => 'login','created_by_huike' => 1,'exception_key' => 'dev login exception','exception_code' => -1000,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612102944,'create_time' => 1612102944]);
		// id = 6
		think\facade\Db::table('huike_controllers')->insert(['id' => 6,'controller_name' => 'User','controller_title' => '用户','path_id' => 4,'module_id' => 1,'route_name' => 'user','created_by_huike' => 1,'exception_key' => 'dev user exception','exception_code' => -1100,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612875654,'create_time' => 1612103316]);
		// id = 7
		think\facade\Db::table('huike_controllers')->insert(['id' => 7,'controller_name' => 'Facade','controller_title' => '门面','path_id' => 2,'module_id' => 1,'route_name' => 'facade','created_by_huike' => 1,'exception_key' => 'dev facade exception','exception_code' => -1200,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612103372,'create_time' => 1612103372]);
		// id = 8
		think\facade\Db::table('huike_controllers')->insert(['id' => 8,'controller_name' => 'Migrate','controller_title' => '数据库迁移','path_id' => 2,'module_id' => 1,'route_name' => 'migrate','created_by_huike' => 1,'exception_key' => 'dev migrate exception','exception_code' => -1500,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612103423,'create_time' => 1612103423]);
		// id = 9
		think\facade\Db::table('huike_controllers')->insert(['id' => 9,'controller_name' => 'Model','controller_title' => '模型','path_id' => 2,'module_id' => 1,'route_name' => 'model','created_by_huike' => 1,'exception_key' => 'dev model exception','exception_code' => -1300,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612103468,'create_time' => 1612103468]);
		// id = 10
		think\facade\Db::table('huike_controllers')->insert(['id' => 10,'controller_name' => 'Actions','controller_title' => '逻辑方法','path_id' => 3,'module_id' => 1,'route_name' => 'actions','created_by_huike' => 1,'exception_key' => 'dev actions exception','exception_code' => -1800,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612103800,'create_time' => 1612103800]);
		// id = 11
		think\facade\Db::table('huike_controllers')->insert(['id' => 11,'controller_name' => 'Controllers','controller_title' => '控制器','path_id' => 3,'module_id' => 1,'route_name' => 'controllers','created_by_huike' => 1,'exception_key' => 'dev controllers exception','exception_code' => -1700,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612103955,'create_time' => 1612103955]);
		// id = 12
		think\facade\Db::table('huike_controllers')->insert(['id' => 12,'controller_name' => 'Module','controller_title' => '模块管理','path_id' => 3,'module_id' => 1,'route_name' => 'modules','created_by_huike' => 1,'exception_key' => 'dev module exception','exception_code' => -1600,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1612875494,'create_time' => 1612103994]);
		// id = 17
		think\facade\Db::table('huike_controllers')->insert(['id' => 17,'controller_name' => 'Developer','controller_title' => '开发者','path_id' => 4,'module_id' => 1,'route_name' => 'developer','is_static_service' => 1,'created_by_huike' => 1,'exception_key' => 'dev developer exception','exception_code' => -2300,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1613535981,'create_time' => 1613535981]);
		// id = 21
		think\facade\Db::table('huike_controllers')->insert(['id' => 21,'controller_name' => 'ControllerPath','controller_title' => '控制器目录','path_id' => 3,'module_id' => 1,'route_name' => 'controller_path','is_static_service' => 1,'created_by_huike' => 1,'exception_key' => 'dev controller path exception','exception_code' => -2400,'exception_msg' => '系统错误，请稍候再试','creator_id' => 1,'update_time' => 1613797119,'create_time' => 1613797119]);
}
}