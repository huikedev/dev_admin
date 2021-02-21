<?php

namespace huikedev\dev_admin\service\user;

use huikedev\dev_admin\service\user\provider\login\Index;
use huikedev\dev_admin\service\user\provider\login\Test;


class LoginService
{

    public function index()
    {
        return app(Index::class,[],true)->handle();
    }

    public function test()
    {
        return app(Test::class,[],true)->handle();
    }


}