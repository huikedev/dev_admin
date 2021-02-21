<?php


namespace huikedev\dev_admin\command;


use huikedev\dev_admin\common\model\huike\HuikeModules;
use huikedev\huike_base\base\BaseCommand;
use huikedev\huike_generator\migration\RunMigration;
use huikedev\huike_generator\migration\RunSeed;
use think\Exception;
use think\facade\Db;

class DevInstall extends BaseCommand
{
    protected $bindDomain;
    protected $routeFile;
    protected $path;
    protected $controllers=[
      'dev.generate.Facade',
      'dev.generate.Migrate',
      'dev.generate.Model',
      'dev.system.Actions',
      'dev.system.ControllerPath',
      'dev.system.Controllers',
      'dev.system.Module',
      'dev.user.Developer',
      'dev.user.Login',
      'dev.user.User',
    ];
    protected function handle()
    {
        $this->path = dirname(__DIR__);
        $this->validate();
        $this->isBindDomain();
        $this->copyRoute();
        $this->copyControllers();
        $this->overwriteConfig();
        $this->migrate();
        $this->output->info("系统安装完成，感谢您的使用！");
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
        // 设置 app domain
        $answer = strtolower($this->output->ask($this->input, '是否为dev_admin绑定主域名? (Y/N) '));
        if($answer ==='y' || $answer === 'yes'){
            $appDomain = strtolower($this->output->ask($this->input, '请输入您需要绑定的主域名，后续可修改 '));
            if(strpos($appDomain,'https://' ) === 0 || strpos($appDomain,'http://') === 0){
                $this->bindDomain = $appDomain;
            }else{
                $this->bindDomain = 'http://' . $appDomain;
            }
        }
    }

    protected function copyControllers()
    {
        $this->output->info("开始安装控制器:");
        foreach ($this->controllers as $controller){
            $this->copyController(str_replace('.',DIRECTORY_SEPARATOR,$controller));
        }
    }

    // 获取初始文件
    protected function getStubContent(string $name): string
    {
        return file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'stub'.DIRECTORY_SEPARATOR.$name.'.stub');
    }

    // 复制控制器
    protected function copyController(string $name)
    {
        $controller = 'app'.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$name.'.php';
        $file = app()->getRootPath().$controller;
        $dir = pathinfo($file,PATHINFO_DIRNAME);
        if (is_dir($dir) === false){
            mkdir($dir,0755,true);
        }
        file_put_contents($file,$this->getStubContent($name));
        $this->output->info("控制器安装成功:".$controller);
    }

    protected function copyRoute()
    {
        $this->routeFile = app()->getRootPath().'huike'.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'dev.php';
        if(file_exists($this->routeFile)){
            throw new Exception('路由文件【'.$this->routeFile.'】已存在');
        }
        $routeContent = "<?php\n\n";
        $routeContent .= 'use think\facade\Route;'."\n\n";
        if(is_null($this->bindDomain)){
            $routeContent .= 'Route::group(\'dev\',function(){'."\n";
        }else{
            $routeContent .= 'Route::domain([\''.$this->bindDomain.'\'],function(){';
        }
        $routeContent .= file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'stub'.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'dev.stub');
        file_put_contents($this->routeFile,$routeContent);
        $this->output->info("路由生成成功:".$this->routeFile);
    }

    protected function overwriteConfig()
    {
        $configContent = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'stub'.DIRECTORY_SEPARATOR.'huike_dev_admin.stub');

        file_put_contents(app()->getConfigPath().'huike_dev_admin.php',$configContent);
    }

    protected function migrate()
    {
        try {
            $this->runMigrates();
            $this->runSeeds();
            $this->setModule();
        }catch (\Exception $e){
            $this->output->info("数据迁移失败:".$e->getMessage());
            $this->output->info("您可以手动导入数据:".$this->path.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'huikedev.sql');
        }
        $this->output->info("数据迁移成功！");
    }

    protected function runMigrates()
    {
        $migratePath = $this->path.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations';
        (new RunMigration())->setPath($migratePath)->handle();
    }

    protected function runSeeds()
    {
        $seedsPath = $this->path.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'seeds';
        (new RunSeed())->setPath($seedsPath)->handle();
    }

    protected function setModule()
    {
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
}