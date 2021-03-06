<?php

namespace huikedev\dev_admin\service\system\facade;


use think\Facade;

/**
 * @see \huikedev\dev_admin\service\system\ControllersService
 * @mixin \huikedev\dev_admin\service\system\ControllersService
 * @method mixed index() static 
 * @method mixed create() static 
 * @method mixed edit() static 
 * @method mixed delete() static 
 * @method mixed unSynced() static 
 * @method mixed sync() static 
 * @method mixed checkException() static 
 * @method mixed simpleList() static
 */
class ControllersService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\system\ControllersService::class;
    }
}