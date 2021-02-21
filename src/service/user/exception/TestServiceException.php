<?php

namespace huikedev\dev_admin\service\user\exception;

use huikedev\huike_base\exceptions\AppServiceException;


class TestServiceException extends AppServiceException
{
    

	public function setExceptionKey()
	{
		$this->exceptionKey = 'dev test exception';
	}

}