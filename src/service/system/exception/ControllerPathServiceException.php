<?php

namespace huikedev\dev_admin\service\system\exception;

use huikedev\dev_admin\common\exception\DevServiceException;


class ControllerPathServiceException extends DevServiceException
{
    

	public function setExceptionKey()
	{
		$this->exceptionKey = 'dev controller path exception';
	}

}