<?php

namespace App\Http\Requests\Dashboard\Location\County;

use App\Models\County;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountyStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Location\County
 *
 * @property integer $province_id
 * @property string  $en_name
 * @property string  $name
 * @property double  $latitude
 * @property double  $longitude
 */
class CountyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [County::class]);
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
            'en_name'     => 'required|string|unique:counties,en_name',
            'name'        => 'required|string|unique:counties,name',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ];
    }
}
