<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/25 0025
 * Time: 23:29
 */

namespace App\Http\Controllers;

use App\Common\Auth\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class JwtLoginController extends BaseController
{
    use ResponseJson;

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        //去数据库或缓存中验证用户
        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid(1)->encode()->getToken();
        return $this->jsonSuccessData([
            'token' => $token
        ]);
    }

    public function info()
    {
        throw new ApiException(ApiErrDesc::ERR_URL);
    }
}