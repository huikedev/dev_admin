<?php


namespace huikedev\dev_admin\service\user\provider\login;

use huikedev\dev_admin\common\model\huike\HuikeDeveloper;
use huikedev\huike_base\facade\AppRequest;
use huikedev\dev_admin\service\user\exception\LoginServiceException;
use huikedev\huike_base\interceptor\auth\facade\Auth;

/**
 * Desc
 * Class Index
 * @package huikedev\dev_admin\service\login\provider
 */
class Index
{
    public function handle():array
    {
        $username = AppRequest::param('username');
        $password = AppRequest::param('password');
        $develop = HuikeDeveloper::where('username','=',$username)->findOrEmpty();
        if($develop->isEmpty()){
            throw new LoginServiceException('账号不存在或密码错误',1);
        }
        if(password_verify($password,$develop->password)===false){
            throw new LoginServiceException('账号不存在或密码错误',6);
        }
        $develop->last_login_ip = $develop->login_ip;
        $develop->last_login_time = $develop->login_time;
        $develop->login_ip = AppRequest::ip();
        $develop->login_time = time();
        $develop->save();
        return ['token'=>Auth::login($develop->id)];
    }
}