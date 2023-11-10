<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required|max:400'
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Необходимо указать название',
            'description.required'    => 'Укажите описание задачи',
            'description.max'      => 'Слишком большое описание (до 400 символов)'
        ];
    }
}
