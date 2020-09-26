<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/26 0026
 * Time: 0:19
 */

namespace App\Exceptions;

use Throwable;
class ApiException extends \RuntimeException
{
    public function __construct(array $apiErrConst, Throwable $previous=null)
    {
        $code = $apiErrConst[0];
        $message = $apiErrConst[1];
        parent::__construct($message, $code, $previous);
    }
}