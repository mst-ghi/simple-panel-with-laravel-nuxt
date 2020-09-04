<?php

namespace App\Http\Requests\Dashboard\Role;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Role
 *
 * @property string $label
 * @property string $title
 * @property string $description
 */
class RoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [Role::class, request('role')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label'       => 'required|string|min:3|unique:roles,label,' . request('role')->id,
            'title'       => 'required|string|min:3|unique:roles,title,' . request('role')->id,
            'description' => 'sometimes|string|min:10',
        ];
    }
}
