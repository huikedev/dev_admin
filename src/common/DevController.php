<?php


namespace huikedev\dev_admin\common;


use huikedev\huike_base\response\AppResponse;

class DevController
{
    protected $response;
    public function __construct()
    {
        $this->response = (new AppResponse());
    }
}