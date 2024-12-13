<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopManagerRequest extends FormRequest
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
            'shop_name' => 'required|string|max:191',
            'category' => 'required|string|max:191',
            'area' => 'required|string|max:191',
            'photo_path' => 'required|string|max:255',
            'detail' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'shop_name.required' => '名前を入力してください',
            'shop_name.string' => '文字列で入力してください',
            'shop_name.max' => '１９１文字以下で入力してください',
            'category.required' => 'カテゴリーを入力してください',
            'category.string' => '文字列で入力してください',
            'category.max' => '１９１文字以下で入力してください',
            'area.required' => 'エリアを入力してください',
            'area.string' => '文字列で入力してください',
            'area.max' => '１９１文字以下で入力してください',
            'photo_path.required' => '写真のパスを入力してください',
            'photo_path.string' => '文字列で入力してください',
            'photo_path.max' => '２５５文字以下で入力してください',
            'detail.required' => '詳細を入力してください',
            'detail.string' => '文字列で入力してください',
        ];
    }
}
