<?php

namespace App\Exceptions\Address;

use Exception;

class AddressOwnedUserException extends Exception
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
            'message' => trans('exceptions.address.owned_user'),
        ], 403);
    }
}
