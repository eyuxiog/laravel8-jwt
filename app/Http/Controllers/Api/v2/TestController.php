<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/2/23
 * Time: 14:36
 */

namespace App\Http\Controllers\Api\v2;

use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    use ResponseJson;

    public function info()
    {
        return $this->jsonSuccessData([
            'token' => 222
        ]);
    }
}
