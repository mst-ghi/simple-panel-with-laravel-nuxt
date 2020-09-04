<?php

namespace App\Exceptions\Code;

use Exception;

class CodeInvalidException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response([
            'success' => false,
            'errors'  => [
                'code' => trans('messages.auth.code.invalid')
            ],
            'message' => trans('messages.auth.code.invalid'),
        ], 422);
    }
}
