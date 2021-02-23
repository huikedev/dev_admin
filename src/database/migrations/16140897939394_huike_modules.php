<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeModules extends Migrator
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

	//原始表创建于：2021-02-23 19:58:41,数据库迁移文件生成于：2021-02-23 22:16:33
		$table = $this->table('huike_modules')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB')->setComment('应用模块');
		$table->setId('id')
			->addColumn(Column::string('module_name',50)->setComment('模块名称（英文），即目录名称'))
			->addColumn(Column::string('module_title',255)->setComment('模块名称（中文）')->setNullable())
			->addColumn(Column::string('route_name',50)->setComment('路由名称（英文）')->setNullable())
			->addColumn(Column::json('route_middleware')->setComment('路由中间件')->setNullable())
			->addColumn(Column::json('bind_domain')->setComment('绑定域名')->setNullable())
			->addColumn(Column::integer('extend_module_id')->setDefault(0)->setComment('第三方模块扩展ID'))
			->addColumn(Column::integer('creator_id')->setDefault(0)->setComment('创建人ID'))
			->addColumn(Column::tinyInteger('edit_level')->setDefault(0)->setComment(''))
			->addColumn(Column::integer('create_time')->setDefault(0)->setComment('创建时间')->setUnsigned())
			->addColumn(Column::integer('update_time')->setDefault(0)->setComment('最后更新时间')->setUnsigned())
			->addColumn(Column::integer('delete_time')->setDefault(0)->setComment('软删除时间')->setUnsigned())
			->addIndex(['module_name'],['unique'=>true])
			->addIndex(['route_name'],['unique'=>true])
			->create();
	}
}
