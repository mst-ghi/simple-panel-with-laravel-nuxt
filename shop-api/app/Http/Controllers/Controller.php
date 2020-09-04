<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use phpDocumentor\Reflection\Types\Boolean;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string  $message
     * @param         $data
     * @param int     $code
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function success(string $message, $data = [], int $code = 200)
    {
        return response([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * @param string  $message
     * @param         $data
     * @param int     $code
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function error(string $message, $data = [], int $code = 200)
    {
        return response([
            'success' => false,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
}
