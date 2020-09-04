<?php

namespace App\Http\Requests\Dashboard\Banner;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;

/**
 * Class BannerUpdateRequest
 *
 * @package App\Http\Requests\Dashboard\Banner
 *
 * @property File    $photo
 * @property integer $brand_id
 * @property integer $category_id
 * @property string  $type
 * @property string  $size
 * @property string  $text
 * @property boolean $close_able
 * @property boolean $status
 * @property string  $expires_type
 * @property integer $expires_value
 */
class BannerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'         => 'sometimes|image|mimes:jpg,jpeg,png',
            'brand_id'      => 'sometimes|exists:brands,id',
            'category_id'   => 'sometimes|exists:categories,id',
            'type'          => 'required|string|in:' . implode(',', Banner::TYPE_LIST),
            'size'          => 'required|string|in:' . implode(',', Banner::SIZE_LIST),
            'text'          => 'sometimes|string',
            'close_able'    => 'required|boolean',
            'status'        => 'required|boolean',
            'expires_type'  => 'sometimes|string|in:' . implode(',', Banner::EXPIRES_LIST),
            'expires_value' => 'sometimes|numeric',
        ];
    }
}
