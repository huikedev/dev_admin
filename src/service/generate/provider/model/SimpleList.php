<?php


namespace huikedev\dev_admin\service\generate\provider\model;

use huikedev\dev_admin\common\model\huike\HuikeModels;

/**
 * Desc
 * Class SimpleList
 * @package huikedev\dev_admin\service\generate\provider\model
 */
class SimpleList
{
    public function handle():\Traversable
    {
        $modelList = HuikeModels::modelSort()->select();
        return $modelList->visible(['model_namespace','model_name']);
    }
}