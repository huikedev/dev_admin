<?php

namespace huikedev\dev_admin\common\middlewares;

use huikedev\dev_admin\common\interceptor\auth\DevAuthProvider;
use huikedev\huike_base\facade\AppRequest;

class DevRouteMiddleware
{
    public function handle($request, \Closure $next)
    {
        AppRequest::setModule('dev');
        AppRequest::setNamespace('huikedev\dev_admin');
        bind('auth',DevAuthProvider::class);
        app('auth')->handle();
        return $next($request);
    }
}