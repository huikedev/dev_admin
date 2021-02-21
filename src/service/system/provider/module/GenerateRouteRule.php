<?php


namespace huikedev\dev_admin\service\system\provider\module;


use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_generator\generator\logic_skeleton\execute\routes\MakeRoutes;

class GenerateRouteRule
{
    public function handle()
    {
        (new MakeRoutes())->handle(AppRequest::id());
        return true;
    }
}