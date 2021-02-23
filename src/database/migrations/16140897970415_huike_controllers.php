<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeControllers extends Migrator
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

	//原始表创建于：2021-02-23 19:57:24,数据库迁移文件生成于：2021-02-23 22:16:37
		$table = $this->table('huike_controllers')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB')->setComment('后端控制器节点');
		$table->setId('id')
			->addColumn(Column::string('controller_name',50)->setComment('控制器标识'))
			->addColumn(Column::string('controller_title',255)->setComment('控制器名称'))
			->addColumn(Column::integer('path_id')->setDefault(0)->setComment('上级目录ID'))
			->addColumn(Column::integer('module_id')->setComment('模块ID')->setUnsigned())
			->addColumn(Column::string('route_name',255)->setDefault('')->setComment('路由标识'))
			->addColumn(Column::tinyInteger('is_static_service')->setDefault(0)->setComment('静态服务代理模式'))
			->addColumn(Column::tinyInteger('created_by_huike')->setDefault(0)->setComment('是否为自动生成'))
			->addColumn(Column::string('exception_key',255)->setComment('异常key')->setNullable())
			->addColumn(Column::integer('exception_code')->setComment('异常code')->setNullable())
			->addColumn(Column::string('exception_msg',255)->setDefault('')->setComment('异常message'))
			->addColumn(Column::integer('creator_id')->setDefault(0)->setComment('创建人ID'))
			->addColumn(Column::tinyInteger('edit_level')->setDefault(0)->setComment(''))
			->addColumn(Column::integer('delete_time')->setDefault(0)->setComment('软删除时间')->setUnsigned())
			->addColumn(Column::integer('update_time')->setDefault(0)->setComment('最后更新时间')->setUnsigned())
			->addColumn(Column::integer('create_time')->setDefault(0)->setComment('创建时间')->setUnsigned())
			->addIndex(['module_id'])
			->addIndex(['exception_key'],['unique'=>true])
			->addIndex(['exception_code'],['unique'=>true])
			->create();
	}
}
