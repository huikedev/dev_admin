<?php

namespace huikedev\dev_admin\service\user;

use huikedev\dev_admin\service\user\provider\login\Index;

class LoginService
{

    public function index()
    {
        return app(Index::class,[],true)->handle();
    }

}