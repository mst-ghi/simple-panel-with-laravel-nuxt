<?php

namespace App\Http\Requests\Dashboard\Role;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Role
 *
 * @property string $label
 * @property string $title
 * @property string $description
 */
class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [Role::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label'       => 'required|string|min:3|unique:roles,label',
            'title'       => 'required|string|min:3|unique:roles,title',
            'description' => 'sometimes|string|min:10',
        ];
    }
}
