<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;

/**
 * Class ProductUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Product
 *
 * @property File    $photo
 * @property array   $category_ids
 * @property array   $item_ids
 * @property integer $brand_id
 * @property string  $title_fa
 * @property string  $title_en
 * @property string  $slug
 * @property double  $price
 * @property double  $price_ld
 * @property string  $short_desc
 * @property string  $long_desc
 * @property boolean $status
 */
class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', [Product::class, request('product')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'          => 'sometimes|image|mimes:jpg,jpeg,png',
            'category_ids'   => 'required|array|min:1',
            'category_ids.*' => 'required|exists:categories,id',
            'item_ids'       => 'required|array|min:1',
            'item_ids.*'     => 'required|exists:attribute_items,id',
            'brand_id'       => 'required|exists:brands,id',
            'title_fa'       => 'required|string|min:2|max:190',
            'title_en'       => 'required|string|min:2|max:190',
            'slug'           => 'required|string|min:2|max:190|unique:products,slug,' . request('product')->id,
            'price'          => 'required|numeric',
            'price_ld'       => 'sometimes|numeric',
            'short_desc'     => 'required|string|min:2|max:255',
            'long_desc'      => 'required|string|min:2',
            'status'         => 'sometimes|boolean',
        ];
    }
}
