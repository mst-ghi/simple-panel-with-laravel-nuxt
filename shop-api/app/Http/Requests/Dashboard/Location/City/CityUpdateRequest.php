<?php

namespace App\Http\Requests\Dashboard\Location\City;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CityUpdateRequest
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
class CityUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [City::class, request('city')]);
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
            'en_name'     => 'required|string|unique:cities,en_name,' . request('city')->id,
            'name'        => 'required|string|unique:cities,name,' . request('city')->id,
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ];
    }
}
