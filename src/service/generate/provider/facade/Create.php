<?php


namespace huikedev\dev_admin\service\generate\provider\facade;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\utils\UtilsTools;
use huikedev\dev_admin\common\model\huike\HuikeFacades;
use huikedev\dev_admin\service\generate\exception\FacadeServiceException;
use huikedev\huike_generator\generator\logic_skeleton\execute\facade\MakeFacade;
use think\helper\Str;

class Create
{
    public function handle()
    {
        $originClass = UtilsTools::replaceNamespace(AppRequest::safeString('origin_class'));
        $facadeClass = AppRequest::safeString('facade_class');
        $facadePath = AppRequest::safeString('facade_path');
        $overwrite = AppRequest::safeBoolean('overwrite');
        $typeId = AppRequest::param('type_id/d');
        if(Str::contains($facadePath,'.php')){
            $facadePath = pathinfo($facadePath,PATHINFO_DIRNAME);
        }
        try{
            $facadeMaker = new MakeFacade();
            if(empty($facadePath) === false){
                $facadeMaker->setPath(UtilsTools::replaceSeparator($facadePath));
            }
            $facadeClass = empty($facadeClass) ? null : UtilsTools::replaceNamespace($facadeClass);
            $facade = $facadeMaker->handle($originClass,$facadeClass,$overwrite);
        }catch (\Exception $e){
            throw new FacadeServiceException($e->getMessage(),11,NoticeType::DIALOG_ERROR,$e);
        }

        $facadeModel = HuikeFacades::where('facade_class','=',$facade->getFacadeClass())->findOrEmpty();
        try{
            $facadeModel->facade_class = $facade->getFacadeClass();
            $facadeModel->origin_class = $originClass;
            $facadeModel->facade_path = str_replace(app()->getRootPath(),'',pathinfo($facade->getFacadeClassPath(),PATHINFO_DIRNAME));
            if(AppRequest::has('facade_title')){
                $facadeModel->facade_title = AppRequest::safeString('facade_title');
            }else{
                $facadeModel->facade_title = $facade->getClassName();
            }
            $facadeModel->type_id = $typeId;
            $facadeModel->update_times = isset($facadeModel->update_times) ? $facadeModel->update_times + 1 : 1;
            $facadeModel->action_count = $facade->getCount();
            $facadeModel->save();
        }catch (\Exception $e){
            throw new FacadeServiceException($e->getMessage(),12,NoticeType::DIALOG_ERROR,$e);
        }

        return true;
    }
}