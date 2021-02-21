<?php

namespace huikedev\dev_admin\service\generate\facade;


use think\Facade;

/**
 * @see \huikedev\dev_admin\service\generate\MigrateService
 * @mixin \huikedev\dev_admin\service\generate\MigrateService
 * @method bool create() static 
 * @method bool run() static 
 * @method bool tableToMigration() static 表字段生成迁移文件
 */
class MigrateService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\generate\MigrateService::class;
    }
}