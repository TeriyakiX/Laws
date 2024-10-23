<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'min:2'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255', 'different:name,email', 'regex:/^[a-zA-Z0-9]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Поле не должно быть пустым',
                'max' => 'Максимально допустимое значение: 255',
                'min' => 'Минимальное допустимое значение: 2',
            ],
            'email' => [
                'required' => 'Поле не должно быть пустым',
                'max' => 'Максимально допустимое значение: 255',
                'email' => 'Неправильный формат почты',
                'unique' => 'Данная почта занята',
            ],
            'password' => [
                'required' => 'Поле не должно быть пустым',
                'max' => 'Максимально допустимое значение: 255',
                'min' => 'Минимальное допустимое значение: 8',
                'different' => 'Поля имя и почта не должны совпадать с паролем',
                'regex' => 'Пароль должен состоять только из латиницы и не иметь пробелов',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Ошибка валидации',
            'error' => $validator->errors()
        ]));
    }
}
