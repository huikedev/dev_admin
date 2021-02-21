<?php


namespace huikedev\dev_admin\service\generate\contract;


use huikedev\dev_admin\service\generate\exception\FacadeServiceException;

abstract class GenerateServiceAbstract
{
    public function __construct()
    {
        if(app()->isDebug()===false){
            throw new FacadeServiceException('代码生成尽在调试模式下可用',1);
        }
    }
}