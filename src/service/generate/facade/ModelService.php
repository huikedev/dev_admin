<?php

namespace huikedev\dev_admin\service\generate\facade;


use think\Facade;
use think\Model;
use think\Paginator;


/**
 * @see \huikedev\dev_admin\service\generate\ModelService
 * @mixin \huikedev\dev_admin\service\generate\ModelService
 * @method Paginator index() static 
 * @method mixed simpleList() static 
 * @method bool create() static 
 * @method bool delete() static 
 * @method bool read() static 
 * @method bool syncProperty() static 
 * @method Model getFields() static
 * @method bool updateAnnotation() static 
 */
class ModelService extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\service\generate\ModelService::class;
    }
}