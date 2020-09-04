<?php

namespace App\Http\Requests\Dashboard\Attribute\Group;

use App\Models\AttributeGroup;
use Illuminate\Foundation\Http\FormRequest;

class AttributeGroupListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('list', [AttributeGroup::class]);
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
