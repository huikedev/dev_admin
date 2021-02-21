<?php

namespace huikedev\dev_admin\common\interceptor\auth;

use huikedev\dev_admin\common\caching\facade\DevActionsCache;
use huikedev\huike_base\facade\AppRequest;
use huikedev\huike_base\interceptor\auth\contract\AuthAbstract;
use huikedev\huike_base\interceptor\auth\support\token\facade\Token;
use huikedev\huike_base\log\HuikeLog;
use think\facade\Config;

class DevAuthProvider extends AuthAbstract
{

    protected function setClient()
    {
        $this->client = AppRequest::module();
    }

    protected function auth()
    {
        if(AppRequest::getTokenName() === Config::get('huike.admin_token_key')){
            $uid = intval(AppRequest::getTokenName());
            $this->setUserId($uid);
        }else{
            $this->token = AppRequest::getToken();
            $tokenCached = Token::setClient($this->client)->verifyToken($this->token);
            $this->setUserId($tokenCached['uid']);
        }
    }

    public function login(int $userId): string
    {
        return Token::setClient($this->client)->createToken($userId);
    }

    public function logout(): bool
    {
        if(is_null($this->token)){
            return true;
        }
        try {
            Token::setClient($this->client)->delete($this->getUserId(),$this->token);
        }catch (\Exception $e){
            HuikeLog::error($e);
        }
        return true;
    }

    protected function isAuthNecessary(): bool
    {
        if(DevActionsCache::isPublic()){
            return false;
        }
        return true;
    }
}