<?php

namespace App\Http\Requests\Dashboard\Attribute\Attribute;

use App\Models\Attribute;
use Illuminate\Foundation\Http\FormRequest;

class AttributeDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('destroy', [Attribute::class, request('attribute')]);
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
