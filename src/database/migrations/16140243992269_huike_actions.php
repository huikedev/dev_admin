<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HuikeActions extends Migrator
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

	//原始表创建于：2021-02-22 23:24:57,数据库迁移文件生成于：2021-02-23 04:06:39
		$table = $this->table('huike_actions')->setCollation('utf8mb4_general_ci')->setEngine('InnoDB')->setComment('控制器方法');
		$table->setId('id')
			->addColumn(Column::string('action_name',255)->setComment('方法名'))
			->addColumn(Column::string('action_title',255)->setComment('方法名称'))
			->addColumn(Column::integer('controller_id')->setComment('控制器ID'))
			->addColumn(Column::string('route_name',255)->setComment('路由别名'))
			->addColumn(Column::tinyInteger('request_method')->setDefault(0)->setComment('请求类型'))
			->addColumn(Column::string('service_return_type',255)->setComment('返回类型'))
			->addColumn(Column::tinyInteger('is_need_permission')->setDefault(1)->setComment('是否需要权限'))
			->addColumn(Column::tinyInteger('notice_type')->setDefault(0)->setComment('前端操作反馈'))
			->addColumn(Column::tinyInteger('response_type')->setDefault(1)->setComment('响应类型'))
			->addColumn(Column::string('remind_msg',255)->setDefault('')->setComment('提示消息'))
			->addColumn(Column::tinyInteger('is_private')->setDefault(1)->setComment('是否公开访问'))
			->addColumn(Column::string('remark',255)->setDefault('')->setComment('备注'))
			->addColumn(Column::integer('creator_id')->setDefault(0)->setComment('创建人ID'))
			->addColumn(Column::integer('create_time')->setDefault(0)->setComment('创建时间')->setUnsigned())
			->addColumn(Column::integer('update_time')->setDefault(0)->setComment('最后更新时间')->setUnsigned())
			->addColumn(Column::integer('delete_time')->setDefault(0)->setComment('软删除时间')->setUnsigned())
			->addIndex(['controller_id'])
			->create();
	}
}
