<?php


namespace huikedev\dev_admin\service\generate\provider\facade;


use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\common\model\huike\HuikeFacades;

class Index
{
    public function handle()
    {
        return HuikeFacades::modelSort('id.desc')->append(['short_origin_class','short_facade_class','creator'])->paginate(AppRequest::middleware('limit'));
    }
}