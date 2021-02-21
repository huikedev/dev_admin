<?php

namespace huikedev\dev_admin\service\system\facade;


use think\Facade;
use think\Paginator;


/**
 * @see \huikedev\dev_admin\service\system\ModuleService
 * @mixin \huikedev\dev_admin\service\system\ModuleService
 * @method Paginator index() static 列表
 * @method bool create() static 新增
 * @method array routeMiddlewares() static 路由中间件列表
 * @method array simpleList() static 简单列表
 * @method array extendModules() static 第三方模块列表
 * @method bool edit() static 修改 修改模块设置
 */
class ModuleService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\system\ModuleService::class;
    }
}