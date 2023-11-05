<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'image' => 'image|max:2048'
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Необходимо указать название',
            'image.image'    => 'Файл должен быть изображением',
            'image.max'      => 'Изображение слишком большое'
         ]; 
    }
}
