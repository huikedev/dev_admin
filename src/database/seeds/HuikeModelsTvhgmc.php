<?php

use think\migration\Seeder;

class HuikeModelsTvhgmc extends Seeder
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
		think\facade\Db::table('huike_models')->insert(['id' => 1,'model_name' => 'HuikeModules','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeModules','module_id' => 1,'remark' => '应用模块','is_json_assoc' => 1,'is_delete_time' => 1,'migrate_version' => 16139307019311,'migrate_file' => 'huikedev\dev_admin\src\database\migrations\16139307019311_huike_modules.php','seed_file' => 'HuikeModulesUfxkbg','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931138]);
		// id = 2
		think\facade\Db::table('huike_models')->insert(['id' => 2,'model_name' => 'HuikeControllers','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeControllers','module_id' => 1,'remark' => '后端控制器','is_delete_time' => 1,'migrate_version' => 16139307057018,'migrate_file' => 'huikedev\dev_admin\src\database\migrations\16139307057018_huike_controllers.php','seed_file' => 'HuikeControllersKheain','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931141]);
		// id = 3
		think\facade\Db::table('huike_models')->insert(['id' => 3,'model_name' => 'HuikeActions','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeActions','module_id' => 1,'remark' => '逻辑方法','is_json_assoc' => 1,'is_delete_time' => 1,'migrate_version' => 16139307106177,'migrate_file' => 'huikedev\dev_admin\src\database\migrations\16139307106177_huike_actions.php','seed_file' => 'HuikeActionsPnughq','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931145]);
		// id = 4
		think\facade\Db::table('huike_models')->insert(['id' => 4,'model_name' => 'HuikeDeveloper','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeDeveloper','module_id' => 1,'remark' => '开发者信息','is_delete_time' => 1,'migrate_version' => 16139307147027,'migrate_file' => 'huikedev\dev_admin\src\database\migrations\16139307147027_huike_developer.php','seed_file' => 'HuikeDeveloperJaclku','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931150]);
		// id = 5
		think\facade\Db::table('huike_models')->insert(['id' => 5,'model_name' => 'HuikeExtendModules','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeExtendModules','module_id' => 1,'remark' => '第三方模块信息','is_create_time' => 0,'is_update_time' => 0,'migrate_version' => 16139306879133,'migrate_file' => 'huikedev\dev_admin\src\database\migrations\16139306879133_huike_extend_modules.php','seed_file' => 'HuikeExtendModulesBychsk','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931129]);
		// id = 6
		think\facade\Db::table('huike_models')->insert(['id' => 6,'model_name' => 'HuikeFacades','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeFacades','module_id' => 1,'remark' => '应用门面','is_delete_time' => 1,'migrate_version' => 16139306981403,'migrate_file' => 'huikedev\dev_admin\src\database\migrations\16139306981403_huike_facades.php','seed_file' => 'HuikeFacadesTbvehf','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931134]);
		// id = 7
		think\facade\Db::table('huike_models')->insert(['id' => 7,'model_name' => 'HuikeModels','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeModels','module_id' => 1,'remark' => '应用模型','is_delete_time' => 1,'is_creator_id' => 1,'migrate_version' => 16139311122396,'migrate_file' => '16139311122396_huike_models','creator_id' => 1,'create_time' => 1610780264,'update_time' => 1613931112]);
}
}