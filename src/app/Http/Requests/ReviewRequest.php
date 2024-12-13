<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ];
    }
    public function messages()
    {
        return [
            'rating.required' => '評価を選択してください。',
            'rating.integer' => '評価は数字で入力してください。',
            'rating.min' => '1人以上を指定してください。',
            'rating.max' => '5人以下を指定してください。',
            'comment.string' => 'コメントは文字列で入力してください。',
            'comment.max' => '500文字以下で入力してください。',
        ];
    }
}
