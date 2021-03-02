<?php

namespace App\Exceptions;

use App\Common\Err\ApiErrDesc;
use Exception;
use App\Http\Response\ResponseJson;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;


class Handler extends ExceptionHandler
{
    use ResponseJson;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

    }
    /*public function report(Exception $exception)
    {
        return parent::report($exception);
    }*/
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, $exception)
    {
        //return parent::reader($request, $exception);
        if ($exception instanceof ApiException) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        } else {
            $code = $exception->getCode();
            if (!$code || $code <= 0) {
                $code = ApiErrDesc::UNKNOWN_ERR[0];
            }
            $message = $exception->getMessage()?:ApiErrDesc::UNKNOWN_ERR[1];
        }
        if (config('app.debug') == true) {
            dump($exception);
        }
        return $this->jsonErrorData($code, $message);
    }
}
