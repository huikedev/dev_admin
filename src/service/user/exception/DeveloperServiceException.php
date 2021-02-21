<?php

namespace huikedev\dev_admin\service\user\exception;

use huikedev\dev_admin\common\exception\DevServiceException;
use huikedev\huike_base\exceptions\AppServiceException;


class DeveloperServiceException extends DevServiceException
{
    

	public function setExceptionKey()
	{
		$this->exceptionKey = 'dev developer exception';
	}

}