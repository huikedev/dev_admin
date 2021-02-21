<?php


namespace huikedev\dev_admin\service\generate\exception;


use huikedev\dev_admin\common\exception\DevServiceException;

class GenerateServiceException extends DevServiceException
{

    protected function setExceptionKey()
    {
        $this->exceptionKey = 'dev generate exception';
    }
}