<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use App\Rules\IranMobile;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 *
 * @package App\Http\Requests\Dashboard\User
 *
 * @property string $username
 * @property string $name
 * @property string $family
 * @property string $mobile
 * @property string $email
 * @property string $password
 */
class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [User::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|min:4|unique:users,username',
            'name'     => 'required|string|min:2',
            'family'   => 'required|string|min:2',
            'mobile'   => ['required', new IranMobile(), 'unique:users,mobile'],
            'email'    => 'required|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }
}
