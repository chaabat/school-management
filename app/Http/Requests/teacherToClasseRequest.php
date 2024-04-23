<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class teacherToClasseRequest extends FormRequest
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
            'user_id' => 'required|unique:teacher_to_classes,user_id',  
            'classe_id' => 'required|unique:teacher_to_classes,classe_id',
            'statut' => 'required|in:activer,desactiver',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'The teacher field is required.',
            'user_id.unique' => 'The teacher is already assigned to a class.',
            'classe_id.required' => 'The class field is required.',
            'classe_id.unique' => 'The class is already assigned to a teacher.',
            'statut.required' => 'The status field is required.',
            'statut.in' => 'The status must be either "activer" or "desactiver".',
        ];
    }
    
}