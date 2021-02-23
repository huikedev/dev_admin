<?php


namespace huikedev\dev_admin\service\generate\provider\facade;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeFacades;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;

class Delete
{
    public function handle()
    {
        $facade = HuikeFacades::where('id','=',AppRequest::id())->findOrEmpty();
        if(DataPermission::canEdit($facade) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }
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