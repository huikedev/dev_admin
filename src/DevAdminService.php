<?php


namespace huikedev\dev_admin;


use huikedev\dev_admin\command\DevInstall;
use think\Service;

class DevAdminService extends Service
{
    public function register()
    {
        $this->commands(DevInstall::class);
    }

    public function boot()
    {
        // 服务启动
    }
}