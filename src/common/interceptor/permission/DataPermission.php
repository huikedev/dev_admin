<?php


namespace huikedev\dev_admin\common\interceptor\permission;


use think\facade\Config;
use think\Model;

class DataPermission
{
    public static function canEdit(Model $model): bool
    {
        return isset($model->edit_level) ? ($model->edit_level < Config::get('huike_dev_admin.edit_level')) : true;
    }
}