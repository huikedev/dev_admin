<?php


namespace huikedev\dev_admin\service\generate\support;


use Phinx\Util\Util;
use think\helper\Str;

class MigrateUtils
{
    public static function getExistingMigrationClassNames(): array
    {
        $classes = [];
        $dir = app()->getRootPath().'database'.DIRECTORY_SEPARATOR.'migrations';
        if(is_dir($dir) === false){
            return $classes;
        }
        $phpFiles = glob($dir . DIRECTORY_SEPARATOR . '*.php');
        foreach ($phpFiles as $filePath) {
            if (preg_match('/([0-9]+)_([_a-z0-9]*).php/', basename($filePath))) {
                $className = Util::mapFileNameToClassName(basename($filePath));
                $classes[$className] = basename($filePath);
            }
        }
        return $classes;
    }

    public static function getVersionAndFile(string $realTableName): array
    {
        $classes = self::getExistingMigrationClassNames();
        if(isset($classes[Str::studly($realTableName)]) === false){
            return [null,null];
        }
        preg_match('/^[0-9]+/', $classes[Str::studly($realTableName)], $matches);
        if(isset($matches[0]) && is_numeric($matches[0])){
            return [$matches[0],app()->getRootPath().'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.$classes[Str::studly($realTableName)]];
        }else{
            return [null,null];
        }
    }
}