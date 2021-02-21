<?php


namespace huikedev\dev_admin\service\generate\provider\facade;


use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeFacades;

class Delete
{
    public function handle()
    {
        $facade = HuikeFacades::where('id','=',AppRequest::id())->findOrEmpty();
        if($facade->isExists()){
            try {
                $facadeClass = new \ReflectionClass($facade->facade_class);
                if(file_exists($facadeClass->getFileName())){
                    unlink($facadeClass->getFileName());
                }
            }catch (\Exception $e){

            }
            $facade->delete();
        }
        return true;
    }
}