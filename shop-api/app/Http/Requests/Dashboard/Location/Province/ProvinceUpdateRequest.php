<?php

namespace App\Http\Requests\Dashboard\Location\Province;

use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProvinceUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Location\Province
 *
 * @property string $name
 * @property string $en_name
 * @property int    $area_code
 * @property double $latitude
 * @property double $longitude
 */
class ProvinceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [Province::class, request('province')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|unique:provinces,name,' . request('province')->id,
            'en_name'   => 'required|string|unique:provinces,en_name,' . request('province')->id,
            'area_code' => 'required|numeric|unique:provinces,area_code,' . request('province')->id,
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }
}
