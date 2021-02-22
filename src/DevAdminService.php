<?php


namespace huikedev\dev_admin;


use huikedev\dev_admin\command\DevAdminInstall;
use think\Service;

class DevAdminService extends Service
{
    public function register()
    {
        if($this->app->config->get('huike_dev_admin.is_installed',false) === false) {
            $this->commands(DevAdminInstall::class);
        }
    }

    public function boot()
    {
        // 服务启动
    }
}