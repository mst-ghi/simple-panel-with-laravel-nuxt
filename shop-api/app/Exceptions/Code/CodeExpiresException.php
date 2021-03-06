<?php

namespace App\Exceptions\Code;

use Exception;

class CodeExpiresException extends Exception
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
                'code' => trans('messages.auth.code.expires')
            ],
            'message' => trans('messages.auth.code.expires'),
        ], 422);
    }
}
