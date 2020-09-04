<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use App\Rules\IranMobile;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserInfoStoreRequest
 *
 * @package App\Http\Requests\Dashboard\User
 *
 * @property string $name
 * @property string $family
 * @property string $mobile
 * @property string $email
 * @property string $password
 */
class UserInfoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('updateInfo', [User::class, request('user')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|min:2',
            'family'   => 'required|string|min:2',
            'mobile'   => ['required', new IranMobile(), 'unique:users,mobile,' . request('user')->id],
            'email'    => 'required|unique:users,email,' . request('user')->id,
            'password' => 'sometimes|string|min:6'
        ];
    }
}
