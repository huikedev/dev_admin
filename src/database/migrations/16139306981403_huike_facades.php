<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeFacades extends Migrator
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

    	//原始表创建于：2021-02-22 01:56:37,数据库迁移文件生成于：2021-02-22 02:04:58
		$table = $this->table('huike_facades')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB');
		$table->setId('id')
			->addColumn(Column::string('origin_class',255)->setComment('原始类名称'))
			->addColumn(Column::string('facade_class',255)->setComment('门面类名称'))
			->addColumn(Column::string('facade_path',255)->setDefault('')->setComment('门面路径'))
			->addColumn(Column::string('facade_title',255)->setDefault('')->setComment('门面中文名称'))
			->addColumn(Column::tinyInteger('type_id')->setDefault(1)->setComment('门面类型'))
			->addColumn(Column::tinyInteger('action_count')->setDefault(0)->setComment('门面类方法数量'))
			->addColumn(Column::tinyInteger('update_times')->setDefault(1)->setComment('更新次数'))
			->addColumn(Column::integer('creator_id')->setDefault(0)->setComment('创建人ID'))
			->addColumn(Column::integer('delete_time')->setDefault(0)->setComment('标记删除')->setUnsigned())
			->addColumn(Column::integer('create_time')->setDefault(0)->setComment('创建时间')->setUnsigned())
			->addColumn(Column::integer('update_time')->setDefault(0)->setComment('更新时间')->setUnsigned())
			->addIndex(['origin_class'])
			->addIndex(['facade_class'])
			->create();
	}
}
