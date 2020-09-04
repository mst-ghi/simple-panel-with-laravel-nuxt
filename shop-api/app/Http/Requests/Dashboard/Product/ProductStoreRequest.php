<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;

/**
 * Class ProductStoreRequest
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
 * @property string  $short_desc
 * @property string  $long_desc
 * @property boolean $status
 */
class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [Product::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'          => 'required|image|mimes:jpg,jpeg,png',
            'category_ids'   => 'required|array|min:1',
            'category_ids.*' => 'required|exists:categories,id',
            'item_ids'       => 'required|array|min:1',
            'item_ids.*'     => 'required|exists:attribute_items,id',
            'brand_id'       => 'required|exists:brands,id',
            'title_fa'       => 'required|string|min:2|max:190',
            'title_en'       => 'required|string|min:2|max:190',
            'slug'           => 'required|string|unique:products,slug|min:2|max:190',
            'price'          => 'required|numeric',
            'short_desc'     => 'required|string|min:2|max:255',
            'long_desc'      => 'required|string|min:2',
            'status'         => 'sometimes|boolean',
        ];
    }
}
