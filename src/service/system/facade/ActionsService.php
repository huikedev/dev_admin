<?php

namespace huikedev\dev_admin\service\system\facade;


use think\Facade;

/**
 * @see \huikedev\dev_admin\service\system\ActionsService
 * @mixin \huikedev\dev_admin\service\system\ActionsService
 * @method mixed index() static 
 * @method mixed create() static 
 * @method mixed edit() static 
 * @method mixed delete() static 
 * @method mixed unSynced() static 
 * @method mixed sync() static 
 */
class ActionsService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\system\ActionsService::class;
    }
}