<?php


namespace huikedev\dev_admin\service\generate;


use huikedev\dev_admin\service\generate\contract\GenerateServiceAbstract;
use huikedev\dev_admin\service\generate\provider\model\Create;
use huikedev\dev_admin\service\generate\provider\model\Delete;
use huikedev\dev_admin\service\generate\provider\model\GetFields;
use huikedev\dev_admin\service\generate\provider\model\Index;
use huikedev\dev_admin\service\generate\provider\model\Read;
use huikedev\dev_admin\service\generate\provider\model\SimpleList;
use huikedev\dev_admin\service\generate\provider\model\SyncProperty;
use huikedev\dev_admin\service\generate\provider\model\UpdateAnnotation;
use think\Model;
use think\Paginator;

class ModelService extends GenerateServiceAbstract
{
    public function index():Paginator
    {
        return app(Index::class,[],true)->handle();
    }

    public function simpleList():\Traversable
    {
        return app(SimpleList::class,[],true)->handle();
    }

    public function create():bool
    {
        return app(Create::class,[],true)->handle();
    }

    public function delete():bool
    {
        return app(Delete::class,[],true)->handle();
    }

    public function read():Model
    {
        return app(Read::class,[],true)->handle();
    }

    public function syncProperty():bool
    {
        return app(SyncProperty::class,[],true)->handle();
    }


    public function getFields():Model
    {
        return app(GetFields::class,[],true)->handle();
    }

    public function updateAnnotation():bool
    {
        return app(UpdateAnnotation::class,[],true)->handle();
    }
}