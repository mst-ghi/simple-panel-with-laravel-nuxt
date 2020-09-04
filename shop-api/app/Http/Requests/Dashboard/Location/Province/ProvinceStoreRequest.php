<?php

namespace App\Http\Requests\Dashboard\Location\Province;

use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProvinceStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Location\Province
 *
 * @property string $name
 * @property string $en_name
 * @property int    $area_code
 * @property double $latitude
 * @property double $longitude
 */
class ProvinceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [Province::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|unique:provinces,name',
            'en_name'   => 'required|string|unique:provinces,en_name',
            'area_code' => 'required|numeric|unique:provinces,area_code',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }
}
