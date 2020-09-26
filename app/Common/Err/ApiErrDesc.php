<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/26 0026
 * Time: 0:07
 */
namespace App\Common\Err;
class ApiErrDesc
{
    const SUCCESS = [0, 'Success'];
    const UNKNOWN_ERR = [1, '未知错误'];
    const ERR_URL = [2, '访问接口不存在'];

    const ERR_PARAMS = [100, '参数错误'];

    /**
     * 1001-1100 用户登录相关的错误码
     */
    const ERR_PASSWORD = [1000, '密码错误'];
}