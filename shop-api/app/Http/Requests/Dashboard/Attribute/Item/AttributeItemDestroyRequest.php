<?php

namespace App\Http\Requests\Dashboard\Attribute\Item;

use App\Models\AttributeItem;
use Illuminate\Foundation\Http\FormRequest;

class AttributeItemDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('destroy', [AttributeItem::class, request('item')]);
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
