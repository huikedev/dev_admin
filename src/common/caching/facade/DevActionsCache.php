<?php

namespace huikedev\dev_admin\common\caching\facade;


use think\Facade;
use think\cache\Driver;


/**
 * @see \huikedev\dev_admin\common\caching\provider\routes\DevActionsCache
 * @mixin \huikedev\dev_admin\common\caching\provider\routes\DevActionsCache
 * @method bool isPublic(string $fullActionName=null) static
 * @method mixed getAll() static 
 * @method Driver cacheHandle() static 
 * @method int getRedisCount() static 
 * @method \huikedev\dev_admin\common\caching\provider\routes\DevActionsCache force() static 
 * @method \huikedev\dev_admin\common\caching\provider\routes\DevActionsCache setExpire(int $expire) static 
 * @method \huikedev\dev_admin\common\caching\provider\routes\DevActionsCache deleteCache() static 
 */
class DevActionsCache extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\common\caching\provider\routes\DevActionsCache::class;
    }
}