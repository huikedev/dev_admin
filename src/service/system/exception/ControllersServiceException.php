<?php


namespace huikedev\dev_admin\service\system\exception;


use huikedev\dev_admin\common\exception\DevServiceException;

class ControllersServiceException extends DevServiceException
{

    protected function setExceptionKey()
    {
        $this->exceptionKey = 'dev controllers exception';
    }
}