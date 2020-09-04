<?php

namespace App\Http\Requests\Dashboard\Attribute\Group;

use App\Models\AttributeGroup;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AttributeGroupUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Attribute\Group
 *
 * @property integer $category_id
 * @property string  $title
 * @property boolean $status
 */
class AttributeGroupUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [AttributeGroup::class, request('group')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|min:2',
            'status'      => 'sometimes|boolean',
        ];
    }
}
