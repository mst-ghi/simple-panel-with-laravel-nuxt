<?php

namespace App\Http\Requests\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class BrandDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('destroy', [Brand::class, request('brand')]);
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
