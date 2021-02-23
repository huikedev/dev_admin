<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeModels extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {

	//原始表创建于：2021-02-23 19:58:19,数据库迁移文件生成于：2021-02-23 22:16:47
		$table = $this->table('huike_models')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB');
		$table->setId('id')
			->addColumn(Column::string('model_name',255)->setComment('模型名称'))
			->addColumn(Column::string('model_full_name',255)->setComment('模型全名'))
			->addColumn(Column::integer('module_id')->setDefault(0)->setComment('模块ID'))
			->addColumn(Column::tinyInteger('base_model_id')->setDefault(1)->setComment('模型基类0=think\Model 1=huike\base\Model 2=第三方模块模型基类'))
			->addColumn(Column::string('table_name',255)->setDefault('')->setComment('模型对应的表名称'))
			->addColumn(Column::string('pk_name',255)->setDefault('')->setComment('主键名称'))
			->addColumn(Column::string('connection_name',255)->setDefault('')->setComment('数据库连接名称'))
			->addColumn(Column::string('remark',255)->setDefault('')->setComment(''))
			->addColumn(Column::tinyInteger('is_json_assoc')->setDefault(0)->setComment(''))
			->addColumn(Column::tinyInteger('is_delete_time')->setDefault(0)->setComment('是否包含软删除时间字段'))
			->addColumn(Column::tinyInteger('is_create_time')->setDefault(1)->setComment('是否包含创建时间字段'))
			->addColumn(Column::tinyInteger('is_update_time')->setDefault(1)->setComment('是否包含更新时间字段'))
			->addColumn(Column::tinyInteger('is_creator_id')->setDefault(0)->setComment('是否包含创建人字段'))
			->addColumn(Column::string('migrate_version',255)->setDefault('')->setComment('数据库迁移版本'))
			->addColumn(Column::string('migrate_file',255)->setDefault('')->setComment('数据库迁移文件'))
			->addColumn(Column::string('seed_file',255)->setDefault('')->setComment('数据库种子文件'))
			->addColumn(Column::integer('creator_id')->setDefault(0)->setComment('创建人ID'))
			->addColumn(Column::tinyInteger('edit_level')->setDefault(0)->setComment(''))
			->addColumn(Column::integer('delete_time')->setDefault(0)->setComment('标记删除')->setUnsigned())
			->addColumn(Column::integer('create_time')->setDefault(0)->setComment('创建时间')->setUnsigned())
			->addColumn(Column::integer('update_time')->setDefault(0)->setComment('更新时间')->setUnsigned())
			->addIndex(['model_name'])
			->create();
	}
}
