<?php

namespace App\Exceptions\User;

use Exception;

class UserNotFoundException extends Exception
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
            'message' => trans('exceptions.user.not_found'),
        ], 404);
    }
}
