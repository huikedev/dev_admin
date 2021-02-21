<?php


namespace huikedev\dev_admin\logic\controller\user;

use huikedev\dev_admin\common\caching\facade\DeveloperCache;
use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use huikedev\huike_base\base\BaseLogic;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\huike_base\interceptor\auth\facade\Auth;

/**
 * Desc
 * Class User
 * @package huikedev\dev_admin\logic\controller\user
 */
class User extends BaseLogic
{
    public function getUserInfo()
    {
        try {
            $this->data = DeveloperCache::setId(Auth::getUserId())->getModel()->append(['position_text'])->hidden(HuikeDeveloper::$hiddenFields);
        }catch (AppServiceException $serviceException){
            throw new AppLogicException($serviceException);
        }
        return $this;
    }

    public function logout()
    {
        Auth::logout();
        return $this;
    }
}