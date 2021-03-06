<?php

use think\migration\Seeder;

class HuikeModelsZeihrm extends Seeder
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
		think\facade\Db::table('huike_models')->insert(['id' => 1,'model_name' => 'HuikeModules','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeModules','module_id' => 1,'remark' => '应用模块','is_json_assoc' => 1,'is_delete_time' => 1,'migrate_version' => 16141325966838,'migrate_file' => '16141325966838_huike_modules','seed_file' => 'HuikeModulesWogcut','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132621]);
		// id = 2
		think\facade\Db::table('huike_models')->insert(['id' => 2,'model_name' => 'HuikeControllers','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeControllers','module_id' => 1,'remark' => '后端控制器','is_delete_time' => 1,'migrate_version' => 16141325995566,'migrate_file' => '16141325995566_huike_controllers','seed_file' => 'HuikeControllersTpiqhb','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132624]);
		// id = 3
		think\facade\Db::table('huike_models')->insert(['id' => 3,'model_name' => 'HuikeActions','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeActions','module_id' => 1,'remark' => '逻辑方法','is_json_assoc' => 1,'is_delete_time' => 1,'migrate_version' => 16141326023468,'migrate_file' => '16141326023468_huike_actions','seed_file' => 'HuikeActionsGuvcbn','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132627]);
		// id = 4
		think\facade\Db::table('huike_models')->insert(['id' => 4,'model_name' => 'HuikeDeveloper','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeDeveloper','module_id' => 1,'remark' => '开发者信息','is_delete_time' => 1,'migrate_version' => 16141326053686,'migrate_file' => '16141326053686_huike_developer','seed_file' => 'HuikeDeveloperWsvzcn','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132630]);
		// id = 5
		think\facade\Db::table('huike_models')->insert(['id' => 5,'model_name' => 'HuikeExtendModules','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeExtendModules','module_id' => 1,'remark' => '第三方模块信息','is_create_time' => 0,'is_update_time' => 0,'migrate_version' => 16141325904496,'migrate_file' => '16141325904496_huike_extend_modules','seed_file' => 'HuikeExtendModulesZhjcsm','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132615]);
		// id = 6
		think\facade\Db::table('huike_models')->insert(['id' => 6,'model_name' => 'HuikeFacades','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeFacades','module_id' => 1,'remark' => '应用门面','is_delete_time' => 1,'migrate_version' => 16141325936372,'migrate_file' => '16141325936372_huike_facades','seed_file' => 'HuikeFacadesAdkltm','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132618]);
		// id = 7
		think\facade\Db::table('huike_models')->insert(['id' => 7,'model_name' => 'HuikeModels','model_full_name' => 'huikedev\dev_admin\common\model\huike\HuikeModels','module_id' => 1,'remark' => '应用模型','is_delete_time' => 1,'is_creator_id' => 1,'migrate_version' => 16141326089697,'migrate_file' => '16141326089697_huike_models','seed_file' => 'HuikeModelsFjoqpy','creator_id' => 1,'edit_level' => 21,'create_time' => 1610780264,'update_time' => 1614132608]);
}
}