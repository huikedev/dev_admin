<?php


namespace huikedev\dev_admin\service\system\support\exceptions;


use huikedev\dev_admin\common\model\huike\HuikeControllers;
use huikedev\dev_admin\common\model\huike\HuikeModules;
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
        if($module->isEmpty()){
            throw new Exception('未找到指定ID为【'.$moduleId.'】的模块');
        }
        $langFile =app()->getRootPath() . $module->huike_path.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh-cn'.DIRECTORY_SEPARATOR.'exception.php';

        $controllers = HuikeControllers::where('module_id','=',$module->id)->where('path_id','>',0)->select();
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