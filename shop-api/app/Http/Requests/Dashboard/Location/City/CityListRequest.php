<?php

namespace App\Http\Requests\Dashboard\Location\City;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

class CityListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('list', [City::class]);
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
