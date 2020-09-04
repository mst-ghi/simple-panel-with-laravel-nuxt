<?php

namespace App\Exceptions;

use Exception;

class PassportTokensException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response([
            'success' => false,
            'message' => trans('exceptions.not_found'),
        ], 404);
    }
}
