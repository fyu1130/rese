<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'shop_id' => 'required|exists:shops,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => ['required','date_format:H:i',
                function ($attribute, $value, $fail) {
                    $dateTime = $this->input('date') . ' ' . $value;
                    if (strtotime($dateTime) < time()) {
                        $fail('予約の日時は現在時刻以降である必要があります。');
                    }
                },],
            'number' => 'required|integer|min:1',
        ];
    }
    public function messages()
    {
        return [
            'shop_id.required' => '店舗を選択してください。',
            'shop_id.exists' => '選択された店舗は存在しません。',
            'date.required' => '予約日を入力してください。',
            'date.date' => '有効な日付形式で入力してください。',
            'date.after_or_equal' => '予約日は今日以降の日付を指定してください。',
            'time.required' => '時間を入力してください。',
            'time.date_format' => '時間は「HH:MM」形式で入力してください。',
            'number.required' => '人数を入力してください。',
            'number.integer' => '人数は数字で入力してください。',
            'number.min' => '1人以上を指定してください。',
        ];
    }
}
