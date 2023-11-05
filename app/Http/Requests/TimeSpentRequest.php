<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeSpentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'time_spent'  => 'required|date_format:H:i',
            'description' => 'required|max:200'
        ];
    }
    
    public function messages(): array
    {
        return [
            'description.required'    => 'Укажите описание работ',
            'description.max'         => 'Слишком большое описание (до 200 символов)',
            'time_spent'              => 'Укажите время',
        ];
    }
}
