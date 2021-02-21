<?php


namespace huikedev\dev_admin\service\system\exception;


use huikedev\dev_admin\common\exception\DevServiceException;

class ActionsServiceException extends DevServiceException
{

    protected function setExceptionKey()
    {
        $this->exceptionKey = 'dev actions exception';
    }
}