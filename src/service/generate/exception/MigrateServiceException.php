<?php


namespace huikedev\dev_admin\service\generate\exception;


use huikedev\dev_admin\common\exception\DevServiceException;

class MigrateServiceException extends DevServiceException
{

    protected function setExceptionKey()
    {
        $this->exceptionKey = 'dev migrate exception';
    }
}