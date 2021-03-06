<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/2/23
 * Time: 14:36
 */

namespace App\Http\Controllers\Api\v1;

use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    use ResponseJson;

    public function info()
    {
        throw new ApiException(ApiErrDesc::ERR_PARAMS);
        /*return $this->jsonSuccessData([
            'token' => 2222312
        ]);*/
    }
}
