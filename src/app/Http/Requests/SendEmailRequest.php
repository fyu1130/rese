<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'recipients' => 'required|array',
            'recipients.*' => 'exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'recipients.required' => '送信先を選択してください。',
            'recipients.*.exists' => '選択した送信先が無効です。',
            'subject.required' => '件名は必須です。',
            'subject.max' => '件名は255文字以内で入力してください。',
            'message.required' => 'メッセージを入力してください。',
        ];
    }
}
