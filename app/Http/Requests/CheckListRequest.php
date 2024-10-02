<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'date' => ['nullable', 'date'],
            'for_myself' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Поле не должно быть пустым',
                'max' => 'Максимально допустимое значение: 255',
                'min' => 'Минимальное допустимое значение: 3',
            ],
            'date' => [
                'date' => 'Дата должна быть в формате: гггг-мм-дд',
            ],
            'for_myself' => [
                'required' => 'Поле не должно быть пустым',
                'boolean' => 'Максимально допустимое значение: 255',
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
