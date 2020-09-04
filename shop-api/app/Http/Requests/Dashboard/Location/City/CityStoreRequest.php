<?php

namespace App\Http\Requests\Dashboard\Location\City;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CityStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Location\City
 *
 * @property integer $province_id
 * @property integer $county_id
 * @property string  $en_name
 * @property string  $name
 * @property double  $latitude
 * @property double  $longitude
 */
class CityStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [City::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'province_id' => 'required|exists:provinces,id',
            'county_id'   => 'required|exists:counties,id',
            'en_name'     => 'required|string|unique:counties,en_name',
            'name'        => 'required|string|unique:counties,name',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ];
    }
}
