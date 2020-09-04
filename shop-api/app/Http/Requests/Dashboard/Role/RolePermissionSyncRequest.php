<?php

namespace App\Http\Requests\Dashboard\Role;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RolePermissionSyncRequest
 *
 * @package App\Http\Requests\Dashboard\Role
 *
 * @property array $permissions
 */
class RolePermissionSyncRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('updatePermissions', [Role::class, request('role')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'required|exists:permissions,id',
        ];
    }
}
