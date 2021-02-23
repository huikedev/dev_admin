<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeExtendModules extends Migrator
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

	//原始表创建于：2021-02-23 04:14:34,数据库迁移文件生成于：2021-02-23 22:16:27
		$table = $this->table('huike_extend_modules')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB')->setComment('三方模块');
		$table->setId('id')
			->addColumn(Column::string('root_path',255)->setComment('模块根目录'))
			->addColumn(Column::string('root_namespace',255)->setComment('根命名空间'))
			->addColumn(Column::string('root_base_exception',255)->setDefault('')->setComment('模块异常基类'))
			->addColumn(Column::string('root_base_model',255)->setDefault('')->setComment('模块模型基类'))
			->addColumn(Column::string('root_base_controller',255)->setDefault('')->setComment('模块控制器基类'))
			->addColumn(Column::string('root_base_logic',255)->setDefault('')->setComment('模块控制器基类'))
			->create();
	}
}
