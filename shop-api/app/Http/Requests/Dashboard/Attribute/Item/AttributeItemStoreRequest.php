<?php

namespace App\Http\Requests\Dashboard\Attribute\Item;

use App\Models\AttributeItem;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AttributeItemStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Attribute\Item
 *
 * @property integer $attribute_id
 * @property string  $title
 * @property boolean $status
 */
class AttributeItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [AttributeItem::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attribute_id' => 'required|exists:attributes,id',
            'title'        => 'required|string',
            'status'       => 'sometimes|boolean',
        ];
    }
}
