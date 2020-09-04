<?php

namespace App\Http\Requests\Dashboard\Attribute\Attribute;

use App\Models\Attribute;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AttributeUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Attribute\Attribute
 *
 * @property integer $attribute_group_id
 * @property string  $type
 * @property string  $title
 * @property string  $slug
 * @property boolean $status
 */
class AttributeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [Attribute::class, request('attribute')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attribute_group_id' => 'required|exists:attribute_groups,id',
            'type'               => 'required|string|in:' . implode(',', Attribute::TYPE_LIST),
            'title'              => 'required|string|min:2',
            'slug'               => 'required|string|min:2',
            'status'             => 'sometimes|boolean',
        ];
    }
}
