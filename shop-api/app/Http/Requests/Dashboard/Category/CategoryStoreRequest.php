<?php

namespace App\Http\Requests\Dashboard\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryStoreRequest
 *
 * @package App\Http\Requests\Dashboard\Category
 *
 * @property integer $parent_id
 * @property string  $slug
 * @property string  $title
 */
class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store', [Category::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'sometimes|exists:categories,id',
            'slug'      => 'required|string|unique:categories,slug',
            'title'     => 'required|string',
        ];
    }
}
