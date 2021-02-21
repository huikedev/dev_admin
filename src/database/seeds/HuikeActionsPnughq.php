<?php

use think\migration\Seeder;

class HuikeActionsPnughq extends Seeder
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
		think\facade\Db::table('huike_actions')->insert(['id' => 1,'action_name' => 'index','action_title' => '登录','controller_id' => 5,'route_name' => 'index','request_method' => 1,'service_return_type' => 'array_object','is_need_permission' => 0,'notice_type' => 3,'remind_msg' => '登录成功，请稍后','is_private' => 0,'creator_id' => 1,'create_time' => 1612119224,'update_time' => 1612119224]);
		// id = 2
		think\facade\Db::table('huike_actions')->insert(['id' => 2,'action_name' => 'getUserInfo','action_title' => '用户详情','controller_id' => 6,'route_name' => 'getUserInfo','service_return_type' => 'array_object','creator_id' => 1,'create_time' => 1612119395,'update_time' => 1612119395]);
		// id = 3
		think\facade\Db::table('huike_actions')->insert(['id' => 3,'action_name' => 'Test','action_title' => '测试','controller_id' => 5,'route_name' => 'test','service_return_type' => 'mixed','creator_id' => 1,'create_time' => 1612119546,'update_time' => 1612155488,'delete_time' => 1612155488]);
		// id = 4
		think\facade\Db::table('huike_actions')->insert(['id' => 4,'action_name' => 'index','action_title' => '列表','controller_id' => 7,'route_name' => 'index','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1612179281,'update_time' => 1612179281]);
		// id = 5
		think\facade\Db::table('huike_actions')->insert(['id' => 5,'action_name' => 'create','action_title' => '新增','controller_id' => 7,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '门面创建成功','creator_id' => 1,'create_time' => 1612179338,'update_time' => 1612179338]);
		// id = 6
		think\facade\Db::table('huike_actions')->insert(['id' => 6,'action_name' => 'delete','action_title' => '删除','controller_id' => 7,'route_name' => 'delete','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '门面删除成功','creator_id' => 1,'create_time' => 1612179383,'update_time' => 1612179383]);
		// id = 7
		think\facade\Db::table('huike_actions')->insert(['id' => 7,'action_name' => 'refresh','action_title' => '刷新','controller_id' => 7,'route_name' => 'refresh','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '门面刷新成功','creator_id' => 1,'create_time' => 1612179418,'update_time' => 1612179418]);
		// id = 8
		think\facade\Db::table('huike_actions')->insert(['id' => 8,'action_name' => 'create','action_title' => '新增','controller_id' => 8,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '数据库迁移文件创建成功','creator_id' => 1,'create_time' => 1612179446,'update_time' => 1612179446]);
		// id = 9
		think\facade\Db::table('huike_actions')->insert(['id' => 9,'action_name' => 'run','action_title' => '执行','controller_id' => 8,'route_name' => 'run','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '数据库迁移执行成功','creator_id' => 1,'create_time' => 1612179476,'update_time' => 1612179476]);
		// id = 10
		think\facade\Db::table('huike_actions')->insert(['id' => 10,'action_name' => 'index','action_title' => '列表','controller_id' => 9,'route_name' => 'index','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1612179492,'update_time' => 1612179492]);
		// id = 11
		think\facade\Db::table('huike_actions')->insert(['id' => 11,'action_name' => 'simpleList','action_title' => '简单列表','controller_id' => 9,'route_name' => 'simpleList','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612179512,'update_time' => 1612179512]);
		// id = 12
		think\facade\Db::table('huike_actions')->insert(['id' => 12,'action_name' => 'create','action_title' => '新增','controller_id' => 9,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '模型创建成功','creator_id' => 1,'create_time' => 1612179533,'update_time' => 1612179533]);
		// id = 13
		think\facade\Db::table('huike_actions')->insert(['id' => 13,'action_name' => 'updateAnnotation','action_title' => '更新注解','controller_id' => 9,'route_name' => 'updateAnnotation','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '模型注解更新成功','creator_id' => 1,'create_time' => 1612179557,'update_time' => 1612179557]);
		// id = 14
		think\facade\Db::table('huike_actions')->insert(['id' => 14,'action_name' => 'delete','action_title' => '删除','controller_id' => 9,'route_name' => 'delete','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '模型删除成功','creator_id' => 1,'create_time' => 1612179574,'update_time' => 1612179574]);
		// id = 15
		think\facade\Db::table('huike_actions')->insert(['id' => 15,'action_name' => 'read','action_title' => '详情','controller_id' => 9,'route_name' => 'read','service_return_type' => 'model','creator_id' => 1,'create_time' => 1612179592,'update_time' => 1612179592]);
		// id = 16
		think\facade\Db::table('huike_actions')->insert(['id' => 16,'action_name' => 'syncProperty','action_title' => '同步属性','controller_id' => 9,'route_name' => 'syncProperty','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '模型属性同步成功','creator_id' => 1,'create_time' => 1612179613,'update_time' => 1612179613]);
		// id = 17
		think\facade\Db::table('huike_actions')->insert(['id' => 17,'action_name' => 'getFields','action_title' => '字段列表','controller_id' => 9,'route_name' => 'getFields','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612179631,'update_time' => 1612179631]);
		// id = 18
		think\facade\Db::table('huike_actions')->insert(['id' => 18,'action_name' => 'index','action_title' => '列表','controller_id' => 10,'route_name' => 'index','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1612179644,'update_time' => 1612179644]);
		// id = 19
		think\facade\Db::table('huike_actions')->insert(['id' => 19,'action_name' => 'create','action_title' => '新增','controller_id' => 10,'route_name' => 'create','request_method' => 1,'service_return_type' => 'array_object','creator_id' => 1,'create_time' => 1612179675,'update_time' => 1612179675]);
		// id = 20
		think\facade\Db::table('huike_actions')->insert(['id' => 20,'action_name' => 'edit','action_title' => '修改','controller_id' => 10,'route_name' => 'edit','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '修改逻辑方法成功','creator_id' => 1,'create_time' => 1612179706,'update_time' => 1612179706]);
		// id = 21
		think\facade\Db::table('huike_actions')->insert(['id' => 21,'action_name' => 'delete','action_title' => '删除','controller_id' => 10,'route_name' => 'delete','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '删除逻辑方法成功','creator_id' => 1,'create_time' => 1612179724,'update_time' => 1612179724]);
		// id = 22
		think\facade\Db::table('huike_actions')->insert(['id' => 22,'action_name' => 'unSynced','action_title' => '未同步列表','controller_id' => 10,'route_name' => 'unSynced','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1612179743,'update_time' => 1612179743]);
		// id = 23
		think\facade\Db::table('huike_actions')->insert(['id' => 23,'action_name' => 'sync','action_title' => '同步方法','controller_id' => 10,'route_name' => 'sync','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '同步逻辑方法成功','creator_id' => 1,'create_time' => 1612179770,'update_time' => 1612179770]);
		// id = 24
		think\facade\Db::table('huike_actions')->insert(['id' => 24,'action_name' => 'speedCreate','action_title' => '一键创建','controller_id' => 10,'route_name' => 'speedCreate','request_method' => 1,'service_return_type' => 'array_object','creator_id' => 1,'create_time' => 1612179807,'update_time' => 1612179807]);
		// id = 25
		think\facade\Db::table('huike_actions')->insert(['id' => 25,'action_name' => 'index','action_title' => '列表','controller_id' => 11,'route_name' => 'index','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1612179819,'update_time' => 1612179819]);
		// id = 26
		think\facade\Db::table('huike_actions')->insert(['id' => 26,'action_name' => 'create','action_title' => '新增','controller_id' => 11,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '控制器创建成功','creator_id' => 1,'create_time' => 1612179840,'update_time' => 1612179840]);
		// id = 27
		think\facade\Db::table('huike_actions')->insert(['id' => 27,'action_name' => 'edit','action_title' => '修改','controller_id' => 11,'route_name' => 'edit','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '控制器修改成功','creator_id' => 1,'create_time' => 1612179860,'update_time' => 1612179860]);
		// id = 28
		think\facade\Db::table('huike_actions')->insert(['id' => 28,'action_name' => 'delete','action_title' => '删除','controller_id' => 11,'route_name' => 'delete','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '控制器删除成功','creator_id' => 1,'create_time' => 1612179877,'update_time' => 1612179877]);
		// id = 29
		think\facade\Db::table('huike_actions')->insert(['id' => 29,'action_name' => 'unSynced','action_title' => '未同步列表','controller_id' => 11,'route_name' => 'unSynced','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612179894,'update_time' => 1612179894]);
		// id = 30
		think\facade\Db::table('huike_actions')->insert(['id' => 30,'action_name' => 'sync','action_title' => '同步','controller_id' => 11,'route_name' => 'sync','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '控制器同步成功','creator_id' => 1,'create_time' => 1612179914,'update_time' => 1612179914]);
		// id = 31
		think\facade\Db::table('huike_actions')->insert(['id' => 31,'action_name' => 'checkException','action_title' => '查询异常码','controller_id' => 11,'route_name' => 'checkException','service_return_type' => 'array_object','creator_id' => 1,'create_time' => 1612179937,'update_time' => 1612179937]);
		// id = 32
		think\facade\Db::table('huike_actions')->insert(['id' => 32,'action_name' => 'simpleList','action_title' => '简单列表','controller_id' => 11,'route_name' => 'simpleList','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612179955,'update_time' => 1612179955]);
		// id = 33
		think\facade\Db::table('huike_actions')->insert(['id' => 33,'action_name' => 'pathList','action_title' => '目录列表','controller_id' => 11,'route_name' => 'pathList','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612179980,'update_time' => 1612179980]);
		// id = 34
		think\facade\Db::table('huike_actions')->insert(['id' => 34,'action_name' => 'index','action_title' => '列表','controller_id' => 12,'route_name' => 'index','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1612179992,'update_time' => 1612179992]);
		// id = 35
		think\facade\Db::table('huike_actions')->insert(['id' => 35,'action_name' => 'create','action_title' => '新增','controller_id' => 12,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '模块创建成功','creator_id' => 1,'create_time' => 1612180010,'update_time' => 1612180010]);
		// id = 36
		think\facade\Db::table('huike_actions')->insert(['id' => 36,'action_name' => 'routeMiddlewares','action_title' => '路由中间件列表','controller_id' => 12,'route_name' => 'routeMiddlewares','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612180029,'update_time' => 1612180029]);
		// id = 37
		think\facade\Db::table('huike_actions')->insert(['id' => 37,'action_name' => 'simpleList','action_title' => '简单列表','controller_id' => 12,'route_name' => 'simpleList','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612180052,'update_time' => 1612180052]);
		// id = 38
		think\facade\Db::table('huike_actions')->insert(['id' => 38,'action_name' => 'updateServiceFacade','action_title' => '刷新服务门面','controller_id' => 7,'route_name' => 'updateServiceFacade','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '刷新服务门面成功','creator_id' => 1,'create_time' => 1612357988,'update_time' => 1612357988]);
		// id = 40
		think\facade\Db::table('huike_actions')->insert(['id' => 40,'action_name' => 'extendModules','action_title' => '第三方模块列表','controller_id' => 12,'route_name' => 'extendModules','service_return_type' => 'array','creator_id' => 1,'create_time' => 1612795237,'update_time' => 1612795237]);
		// id = 42
		think\facade\Db::table('huike_actions')->insert(['id' => 42,'action_name' => 'edit','action_title' => '修改','controller_id' => 12,'route_name' => 'edit','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '修改模块设置成功','remark' => '修改模块设置','creator_id' => 1,'create_time' => 1612873972,'update_time' => 1612873972]);
		// id = 43
		think\facade\Db::table('huike_actions')->insert(['id' => 43,'action_name' => 'generateRouteRule','action_title' => '生成路由','controller_id' => 12,'route_name' => 'generateRouteRule','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '路由生成成功，请前往对应的模块目录查看','remark' => '路由生成','creator_id' => 1,'create_time' => 1612875222,'update_time' => 1612875222]);
		// id = 44
		think\facade\Db::table('huike_actions')->insert(['id' => 44,'action_name' => 'index','action_title' => '列表','controller_id' => 17,'route_name' => 'index','service_return_type' => 'paginator','creator_id' => 1,'create_time' => 1613536801,'update_time' => 1613536801]);
		// id = 45
		think\facade\Db::table('huike_actions')->insert(['id' => 45,'action_name' => 'update','action_title' => '修改','controller_id' => 17,'route_name' => 'update','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '开发者信息修改成功','creator_id' => 1,'create_time' => 1613562995,'update_time' => 1613562995]);
		// id = 46
		think\facade\Db::table('huike_actions')->insert(['id' => 46,'action_name' => 'delete','action_title' => '删除','controller_id' => 17,'route_name' => 'delete','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '开发者删除成功','creator_id' => 1,'create_time' => 1613563038,'update_time' => 1613563038]);
		// id = 47
		think\facade\Db::table('huike_actions')->insert(['id' => 47,'action_name' => 'positionList','action_title' => '岗位列表','controller_id' => 17,'route_name' => 'positionList','service_return_type' => 'array','creator_id' => 1,'create_time' => 1613623640,'update_time' => 1613623640]);
		// id = 48
		think\facade\Db::table('huike_actions')->insert(['id' => 48,'action_name' => 'create','action_title' => '新增','controller_id' => 17,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '开发者添加成功','creator_id' => 1,'create_time' => 1613631699,'update_time' => 1613631699]);
		// id = 49
		think\facade\Db::table('huike_actions')->insert(['id' => 49,'action_name' => 'tableToMigration','action_title' => '表字段生成迁移文件','controller_id' => 8,'route_name' => 'tableToMigration','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '从表字段生成迁移文件成功','creator_id' => 1,'create_time' => 1613748224,'update_time' => 1613748224]);
		// id = 50
		think\facade\Db::table('huike_actions')->insert(['id' => 50,'action_name' => 'tableToSeeds','action_title' => '表数据生成种子文件','controller_id' => 8,'route_name' => 'tableToSeeds','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '表数据生成种子文件成功！','creator_id' => 1,'create_time' => 1613751850,'update_time' => 1613751850]);
		// id = 51
		think\facade\Db::table('huike_actions')->insert(['id' => 51,'action_name' => 'index','action_title' => '首页','controller_id' => 21,'route_name' => 'index','service_return_type' => 'paginator','remark' => '首页','creator_id' => 1,'create_time' => 1613797768,'update_time' => 1613797768]);
		// id = 52
		think\facade\Db::table('huike_actions')->insert(['id' => 52,'action_name' => 'create','action_title' => '新增','controller_id' => 21,'route_name' => 'create','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '控制器目录创建成功！','remark' => '新增','creator_id' => 1,'create_time' => 1613797768,'update_time' => 1613797768]);
		// id = 53
		think\facade\Db::table('huike_actions')->insert(['id' => 53,'action_name' => 'edit','action_title' => '修改','controller_id' => 21,'route_name' => 'edit','request_method' => 1,'service_return_type' => 'bool','notice_type' => 6,'remind_msg' => '控制器目录修改成功！','remark' => '修改','creator_id' => 1,'create_time' => 1613797768,'update_time' => 1613797768]);
		// id = 54
		think\facade\Db::table('huike_actions')->insert(['id' => 54,'action_name' => 'delete','action_title' => '删除','controller_id' => 21,'route_name' => 'delete','request_method' => 1,'service_return_type' => 'bool','notice_type' => 9,'remind_msg' => '控制器目录删除成功！','remark' => '删除','creator_id' => 1,'create_time' => 1613797768,'update_time' => 1613797768]);
		// id = 55
		think\facade\Db::table('huike_actions')->insert(['id' => 55,'action_name' => 'simpleList','action_title' => '简单列表','controller_id' => 21,'route_name' => 'simpleList','service_return_type' => 'array','creator_id' => 1,'create_time' => 1613804705,'update_time' => 1613804705]);
}
}