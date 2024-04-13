<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectToClasseRequest extends FormRequest
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
            'subject_id' => 'required',
            'statut' => 'required|in:activer,desactiver',
        ];
    }
 /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'classe_id.required' => 'Le champ "Classe" est requis.',
            'subject_id.required' => 'Le champ "Subject" est requis.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être "activer" ou "desactiver".',
        ];
    }
}
