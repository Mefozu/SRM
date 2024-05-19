<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authorize extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
        {
            return  [
                'email' => 'required|exists:users,email',
            ];
        }

        public function messages(){
        return [
            'email.required' => 'Email обязательное поле ввода',
            'email.exists' => 'Такого Email не существует'
        ];
        }
}
