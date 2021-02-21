<?php


namespace huikedev\dev_admin\logic\controller\system;


use huikedev\huike_base\base\LogicTrait;

class FrontRoutes
{
    use LogicTrait;

    public function index()
    {
        $this->data = ['a'=>1];
        return $this;
    }
}