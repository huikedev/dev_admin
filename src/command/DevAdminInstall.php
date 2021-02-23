<?php


namespace huikedev\dev_admin\command;


use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\base\install\InstallAbstract;
use think\Exception;
use think\facade\Db;

class DevAdminInstall extends InstallAbstract
{
    protected $description = 'install dev admin';
    protected $sqlFile = 'huikedev.sql';
    protected $bindDomain;
    protected $routeFile;
    protected $path;
    protected $migrateStatus = true;
    protected $copyFiles=[
        'app.controller.dev.generate.Facade',
        'app.controller.dev.generate.Migrate',
        'app.controller.dev.generate.Model',
        'app.controller.dev.system.Actions',
        'app.controller.dev.system.ControllerPath',
        'app.controller.dev.system.Controllers',
        'app.controller.dev.system.Module',
        'app.controller.dev.user.Developer',
        'app.controller.dev.user.Login',
        'app.controller.dev.user.User',
    ];

    protected function setRootPath(): void
    {
        $this->rootPath = dirname(__DIR__);
    }

    protected function handle()
    {

        $this->validate();
        $this->isBindDomain();
        $this->copyRoute();
        $this->copyControllers();
        $this->overwriteConfig();
        $this->runMigrates();
        $this->runSeeds();
        $this->setModule();
        $this->output->info("系统安装完成，感谢您的使用！原始文件已生成备份，您可以比对代码来增加被覆盖的逻辑！");
    }

    protected function validate()
    {
        $res = Db::query('select @@version;');
        if(isset($res[0]['@@version']) === false){
            throw new Exception('未获取到mysql版本号，本项目依赖mysql 5.7.*');
        }
        if(strpos($res[0]['@@version'],'5.7')!==0){
            throw new Exception('不支持的数据库版本：'.$res[0]['@@version']);
        }
    }

    protected function isBindDomain()
    {
        // 是否绑定域名
        $answer = strtolower($this->output->ask($this->input, '是否为dev_admin绑定主域名? (Y/N) '));
        if($answer ==='y' || $answer === 'yes'){
            $appDomain = strtolower($this->output->ask($this->input, '请输入您需要绑定的主域名，后续可修改 '));
            if(strpos($appDomain,'https://' ) === 0 ){
                $appDomain = str_replace('https://','',$appDomain);
            }
            if(strpos($appDomain,'http://' ) === 0 ){
                $appDomain = str_replace('http://','',$appDomain);
            }
            $appDomain = trim($appDomain,'/');
            $this->bindDomain = $appDomain;
        }
    }

    protected function copyControllers()
    {
        foreach ($this->copyFiles as $file){
            $this->copyFile(str_replace('.',DIRECTORY_SEPARATOR,$file));
            $array = explode('.',$file);
            $controller = array_pop($array);
            $this->output->info("控制器安装成功:".$controller);
        }
    }

    protected function copyRoute()
    {
        $routeContent = "<?php\n\n";
        $routeContent .= 'use think\facade\Route;'."\n\n";
        if(is_null($this->bindDomain)){
            $routeContent .= 'Route::group(\'dev\',function(){'."\n";
        }else{
            $routeContent .= 'Route::domain([\''.$this->bindDomain.'\'],function(){';
        }
        $routeContent .= $this->getStubContent('huike'.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'dev');
        $this->makeRoute('dev',$routeContent);
        $this->output->info("路由生成成功:".$this->routeFile);
    }

    protected function overwriteConfig()
    {
        $this->copyFile('config'.DIRECTORY_SEPARATOR.'huike_dev_admin');
    }

    protected function setModule()
    {
        try {
            if($this->seedsStatus){
                $module = HuikeModules::where('id','=',1)->findOrEmpty();
                if($module->isEmpty()){
                    throw new Exception('未找到ID=1的模块信息');
                }
                if(is_null($this->bindDomain)){
                    $module->bind_domain = null;
                }else{
                    $module->bind_domain = [$this->bindDomain];
                }
                $module->save();
            }
        }catch (\Exception $e){
            $this->output->warning("模块数据更新失败:".$e->getMessage());
        }

    }

}