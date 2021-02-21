<?php

namespace huikedev\dev_admin\service\user\exception;

use huikedev\dev_admin\common\exception\DevServiceException;


class LoginServiceException extends DevServiceException
{

	public function setExceptionKey()
	{
		$this->exceptionKey = 'dev login exception';
	}

}