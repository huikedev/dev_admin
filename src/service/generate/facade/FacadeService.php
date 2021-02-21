<?php

namespace huikedev\dev_admin\service\generate\facade;


use think\Facade;
use think\Paginator;


/**
 * @see \huikedev\dev_admin\service\generate\FacadeService
 * @mixin \huikedev\dev_admin\service\generate\FacadeService
 * @method Paginator index() static
 * @method mixed create() static 
 * @method mixed delete() static 
 * @method mixed updateServiceFacade() static
 * @method mixed refresh() static
 */
class FacadeService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\generate\FacadeService::class;
    }
}