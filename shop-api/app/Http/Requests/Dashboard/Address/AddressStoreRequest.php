<?php

namespace App\Http\Requests\Dashboard\Address;

use App\Models\Address;
use App\Rules\IranMobile;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddressStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Address
 *
 * @property integer $city_id
 * @property string  $mobile
 * @property string  $phone
 * @property string  $name
 * @property string  $family
 * @property string  $address
 * @property string  $postal_code
 * @property double  $latitude
 * @property double  $longitude
 * @property boolean $default
 */
class AddressStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [Address::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id'     => 'required|exists:cities,id',
            'mobile'      => ['required', new IranMobile()],
            'phone'       => 'sometimes|string',
            'name'        => 'required|string',
            'family'      => 'required|string',
            'address'     => 'required|string',
            'postal_code' => 'required|string',
            'latitude'    => 'sometimes|numeric',
            'longitude'   => 'sometimes|numeric',
            'default'     => 'sometimes|boolean',
        ];
    }
}
