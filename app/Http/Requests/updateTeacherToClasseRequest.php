<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateTeacherToClasseRequest extends FormRequest
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
            'classe_id' => 'required',
                'user_id' => 'required',
                'statut' => 'required|in:activer,desactiver',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The teacher field is required.',
             'classe_id.required' => 'The class field is required.',
             'statut.required' => 'The status field is required.',
            'statut.in' => 'The status must be either "activer" or "desactiver".',
        ];
    }
}
