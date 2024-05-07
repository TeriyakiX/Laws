<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeliefRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'start_date' => 'required',
            'last_complate_date' => 'required',
            'end_date' => 'nullable',
            'percent' => 'nullable',
            'is_сontinues' => 'nullable',
        ];
    }
}
