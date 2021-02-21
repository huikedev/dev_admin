<?php


namespace huikedev\dev_admin\service\system\provider\controllers;


use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\facade\ExceptionLang;

class CheckException
{
    public function handle():array
    {
        $checkType = AppRequest::safeString('type');
        if($checkType === 'code'){
            return [
                'result'=>in_array(AppRequest::safeInteger('value'),ExceptionLang::allCode()) === false,
                'type'=>'code'
            ];
        }else{
            return [
                'result'=>in_array(AppRequest::safeString('value'),ExceptionLang::allKey()) === false,
                'type'=>'key'
            ];
        }
    }
}