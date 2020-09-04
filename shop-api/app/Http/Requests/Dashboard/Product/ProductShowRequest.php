<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('show', [Product::class, request('product')]);
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
