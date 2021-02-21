<?php

namespace huikedev\dev_admin\service\user\facade;


use think\Facade;

/**
 * @see \huikedev\dev_admin\service\user\LoginService
 * @mixin \huikedev\dev_admin\service\user\LoginService
 * @method mixed index() static 
 */
class LoginService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\user\LoginService::class;
    }
}