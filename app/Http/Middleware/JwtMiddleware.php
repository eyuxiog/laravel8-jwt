<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/25 0025
 * Time: 23:57
 */

namespace App\Http\Middleware;


use App\Common\Auth\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use Closure;

class JwtMiddleware
{
    use ResponseJson;

    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        if ($token) {
            $jwtAuth = JwtAuth::getInstance();
            $jwtAuth->setToken($token);
            if ($jwtAuth->validate() && $jwtAuth->verify()) {
                return $next($request);
            } else {
                throw new ApiException(ApiErrDesc::UNKNOWN_ERR);
            }
        } else {
            throw new ApiException(ApiErrDesc::ERR_URL);
        }
    }
}
