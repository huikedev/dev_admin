<?php


namespace huikedev\dev_admin\service\generate\exception;


use huikedev\dev_admin\common\exception\DevServiceException;

class ModelServiceException extends DevServiceException
{

    protected function setExceptionKey()
    {
        $this->exceptionKey = 'dev model exception';
    }
}