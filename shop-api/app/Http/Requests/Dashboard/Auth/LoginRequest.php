<?php

namespace App\Http\Requests\Dashboard\Auth;

use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 *
 * @package App\Http\Requests\Dashboard\Auth
 *
 * @property string $username
 * @property string $password
 * @property string $recaptcha
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'  => 'required|string|min:2',
            'password'  => 'required|string|min:6',
//            'recaptcha' => ['required', new Recaptcha()],
        ];
    }
}
