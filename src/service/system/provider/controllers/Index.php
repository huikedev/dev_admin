<?php


namespace huikedev\dev_admin\service\system\provider\controllers;

use huikedev\dev_admin\repository\huike\HuikeControllersRepository;
use huikedev\huike_base\facade\AppRequest;

class Index
{

    public function handle()
    {
        return (new HuikeControllersRepository())->indexPaginate(AppRequest::safeInteger('module_id'));
    }

}