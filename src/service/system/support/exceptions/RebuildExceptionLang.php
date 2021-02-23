<?php


namespace huikedev\dev_admin\service\system\support\exceptions;


use huikedev\dev_admin\common\interceptor\permission\DataPermission;
use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\interceptor\auth\exception\PermissionException;
use think\Exception;
use think\facade\Config;

class RebuildExceptionLang
{
    public function handle(int $moduleId)
    {
        /**
         * @var HuikeModules $module
         */
        $module = HuikeModules::with('extend_module')->where('id','=',$moduleId)->findOrEmpty();

        if(DataPermission::canEdit($module) === false){
            throw new PermissionException('当前数据状态不可编辑',1);
        }

        if($module->isEmpty()){
            throw new Exception('未找到指定ID为【'.$moduleId.'】的模块');
        }
        $langFile =app()->getRootPath() . $module->huike_path.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh-cn'.DIRECTORY_SEPARATOR.'exception.php';
        if($module->extend_module_id === 0){
            $moduleIds = app(HuikeModules::class,[],true)->where('extend_module_id','=',0)->column('id');
        }else{
            $moduleIds = [$moduleId];
        }
        $controllers = HuikeControllers::where('module_id','in',$moduleIds)->where('path_id','>',0)->select();
        $fileContent = '<?php'."\n\n";
        $fileContent .= 'return ['."\n";
        foreach ($controllers as $controller){
            /**
             *  @var HuikeControllers $controller
             */
            if(empty($controller->exception_key)===false && empty($controller->exception_code)===false){
                $fileContent .= "\t'".$controller->exception_key."'\t\t=> ['code' =>".$controller->exception_code.",'msg' => '".(empty($controller->exception_msg) ? Config::get('app.error_message') : $controller->exception_msg)."'],\n";
            }
        }
        $fileContent .="];";
        if(!is_dir(dirname($langFile))){
            mkdir(dirname($langFile),0755,true);
        }
        if(file_exists($langFile)){
            unlink($langFile);
        }
        file_put_contents($langFile,$fileContent);
        return true;
    }
}