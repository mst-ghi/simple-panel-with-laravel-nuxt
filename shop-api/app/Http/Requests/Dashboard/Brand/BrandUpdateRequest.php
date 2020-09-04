<?php

namespace App\Http\Requests\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;

/**
 * Class BrandUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Brand
 *
 * @property string $slug
 * @property string $title
 * @property File   $photo
 */
class BrandUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [Brand::class, request('brand')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug'  => 'required|string|unique:brands,slug,' . request('brand')->id,
            'title' => 'required|string',
            'photo' => 'sometimes|image|mimes:jpg,jpeg,png',
        ];
    }
}
