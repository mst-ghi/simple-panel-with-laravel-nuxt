<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserInfoShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('showInfo', [User::class, request('user')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
