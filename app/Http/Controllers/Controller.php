<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseJson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ResponseJson;
    public function index()
    {
        return $this->jsonSuccessData(['hello' => 123]);
    }
}
