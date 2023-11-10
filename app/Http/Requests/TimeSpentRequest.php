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
        //date_format:H:i
        return [
            'time_spent'  => 'required|min:5|max:8',
            'description' => 'required|max:400'
        ];
    }
    
    public function messages(): array
    {
        return [
            'description.required'    => 'Укажите описание работ',
            'description.max'         => 'Слишком большое описание (до 400 символов)',
            'time_spent'              => 'Укажите время',
        ];
    }
}
