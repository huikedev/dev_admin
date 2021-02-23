<?php

use think\migration\Seeder;

class HuikeModelsGpcfik extends Seeder
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
		think\facade\Db::table('huike_models')->insert(['id' => 1,'model_name' => 'HuikeModules','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeModules','module_id' => 1,'remark' => '应用模块','is_json_assoc' => 1,'is_delete_time' => 1,'migrate_version' => 16140856022570,'migrate_file' => '16140856022570_huike_modules','seed_file' => 'HuikeModulesXbzmeo','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085629]);
		// id = 2
		think\facade\Db::table('huike_models')->insert(['id' => 2,'model_name' => 'HuikeControllers','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeControllers','module_id' => 1,'remark' => '后端控制器','is_delete_time' => 1,'migrate_version' => 16140856058588,'migrate_file' => '16140856058588_huike_controllers','seed_file' => 'HuikeControllersVtjokb','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085633]);
		// id = 3
		think\facade\Db::table('huike_models')->insert(['id' => 3,'model_name' => 'HuikeActions','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeActions','module_id' => 1,'remark' => '逻辑方法','is_json_assoc' => 1,'is_delete_time' => 1,'migrate_version' => 16140856102498,'migrate_file' => '16140856102498_huike_actions','seed_file' => 'HuikeActionsDnmfgl','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085636]);
		// id = 4
		think\facade\Db::table('huike_models')->insert(['id' => 4,'model_name' => 'HuikeDeveloper','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeDeveloper','module_id' => 1,'remark' => '开发者信息','is_delete_time' => 1,'migrate_version' => 16140856139271,'migrate_file' => '16140856139271_huike_developer','seed_file' => 'HuikeDeveloperWcgzyd','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085640]);
		// id = 5
		think\facade\Db::table('huike_models')->insert(['id' => 5,'model_name' => 'HuikeExtendModules','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeExtendModules','module_id' => 1,'remark' => '第三方模块信息','is_create_time' => 0,'is_update_time' => 0,'migrate_version' => 16140855952440,'migrate_file' => '16140855952440_huike_extend_modules','seed_file' => 'HuikeExtendModulesYksoew','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085622]);
		// id = 6
		think\facade\Db::table('huike_models')->insert(['id' => 6,'model_name' => 'HuikeFacades','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeFacades','module_id' => 1,'remark' => '应用门面','is_delete_time' => 1,'migrate_version' => 16140855986683,'migrate_file' => '16140855986683_huike_facades','seed_file' => 'HuikeFacadesKsbmfv','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085626]);
		// id = 7
		think\facade\Db::table('huike_models')->insert(['id' => 7,'model_name' => 'HuikeModels','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeModels','module_id' => 1,'remark' => '应用模型','is_delete_time' => 1,'is_creator_id' => 1,'migrate_version' => 16140856174165,'migrate_file' => '16140856174165_huike_models','seed_file' => 'HuikeModelsQrsjlw','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614085617]);
}
}