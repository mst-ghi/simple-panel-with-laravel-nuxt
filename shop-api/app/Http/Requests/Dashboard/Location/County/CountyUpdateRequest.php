<?php

namespace App\Http\Requests\Dashboard\Location\County;

use App\Models\County;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountyUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Location\County
 *
 * @property integer $province_id
 * @property string  $en_name
 * @property string  $name
 * @property double  $latitude
 * @property double  $longitude
 */
class CountyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [County::class, request('county')]);
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
            'en_name'     => 'required|string|unique:counties,en_name,' . request('county')->id,
            'name'        => 'required|string|unique:counties,name,' . request('county')->id,
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ];
    }
}
