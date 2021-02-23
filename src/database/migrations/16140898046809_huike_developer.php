<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeDeveloper extends Migrator
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

	//原始表创建于：2021-02-23 04:14:34,数据库迁移文件生成于：2021-02-23 22:16:44
		$table = $this->table('huike_developer')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB')->setComment('管理员用户表');
		$table->setId('id')
			->addColumn(Column::string('username',50)->setComment('用户名'))
			->addColumn(Column::string('password',255)->setComment('登录密码'))
			->addColumn(Column::tinyInteger('position_id')->setDefault(0)->setComment('职位ID'))
			->addColumn(Column::string('last_login_ip',50)->setDefault('')->setComment('上次登录IP'))
			->addColumn(Column::integer('login_time')->setDefault(0)->setComment('当次登录时间'))
			->addColumn(Column::string('login_ip',50)->setDefault('')->setComment('当次登录IP'))
			->addColumn(Column::integer('last_login_time')->setDefault(0)->setComment('最后登录时间')->setUnsigned())
			->addColumn(Column::integer('creator_id')->setDefault(0)->setComment(''))
			->addColumn(Column::integer('delete_time')->setDefault(0)->setComment('删除时间')->setUnsigned())
			->addColumn(Column::integer('create_time')->setDefault(0)->setComment('创建时间')->setUnsigned())
			->addColumn(Column::integer('update_time')->setDefault(0)->setComment('更新时间')->setUnsigned())
			->addIndex(['username'])
			->create();
	}
}
