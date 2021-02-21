<?php

namespace huikedev\dev_admin\common\exception;

use huike\common\exception\ExceptionConst;
use huikedev\huike_base\exceptions\AppServiceException;
use think\facade\Lang;

abstract class DevServiceException extends AppServiceException
{
    public function __construct(string $appMsg, int $code, int $noticeType = ExceptionConst::NOTICE_TYPE, \Throwable $previous = null, string $error = null, int $errorLevel = 0, array $appData = [])
    {
        $dir = __DIR__;
        $langDir = str_replace('common'.DIRECTORY_SEPARATOR.'exception','',$dir);
        $langDir .='lang'.DIRECTORY_SEPARATOR.Lang::defaultLangSet().DIRECTORY_SEPARATOR.'exception.php';
        parent::setExceptionLang($langDir);
        parent::__construct($appMsg, $code, $noticeType, $previous, $error, $errorLevel, $appData);
    }
}