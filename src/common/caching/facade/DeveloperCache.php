<?php

namespace huikedev\dev_admin\common\caching\facade;


use think\Facade;
use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use think\cache\Driver;


/**
 * @see \huikedev\dev_admin\common\caching\provider\user\DeveloperCache
 * @mixin \huikedev\dev_admin\common\caching\provider\user\DeveloperCache
 * @method int getId() static 
 * @method HuikeDeveloper getModel() static 
 * @method \huikedev\dev_admin\common\caching\provider\user\DeveloperCache setId( $id) static 
 * @method Driver cacheHandle() static 
 * @method int getRedisCount() static 
 * @method \huikedev\dev_admin\common\caching\provider\user\DeveloperCache force() static 
 * @method \huikedev\dev_admin\common\caching\provider\user\DeveloperCache setExpire(int $expire) static 
 * @method \huikedev\dev_admin\common\caching\provider\user\DeveloperCache deleteCache() static 
 */
class DeveloperCache extends Facade
{
    protected static function getFacadeClass()
    {
        return \huikedev\dev_admin\common\caching\provider\user\DeveloperCache::class;
    }
}