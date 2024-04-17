<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClasseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow anyone to make this request for now
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4,' . $this->route('parent'), 
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
            'name.required' => 'Le nom est requis.',
            'name.min' => 'Le nom doit comporter au moins 4 caractères.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être "activer" ou "desactiver".',
        ];
    }
}
