<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/25 0025
 * Time: 22:47
 */
namespace App\Http\Response;
trait ResponseJson
{
    /**
     * 当接口出现业务异常时的返回
     * @param $code
     * @param $message
     * @param array $data
     * @return false|string
     */
    public function jsonErrorData($code, $message, $data = [], $httpCode = 500)
    {
        return $this->jsonResponse($code, $message, $data, $httpCode);
    }
    /**
     * app接口请求成功时返回
     * @param array $data
     * @return false|string
     */
    public function jsonSuccessData($data = [], $httpCode = 200)
    {
        return $this->jsonResponse(0, 'success', $data, $httpCode);
    }
    /**
     * 返回一个json
     * @param $code
     * @param $message
     * @param $data
     * @return false|string
     */
    private function jsonResponse($code, $message, $data, $httpCode = 200)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data,
        ];
        return response()->json($content, $httpCode);
    }
}
