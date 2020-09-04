<?php

namespace App\Http\Requests\Dashboard\Location\Province;

use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;

class ProvinceDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('destroy', [Province::class, request('province')]);
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
