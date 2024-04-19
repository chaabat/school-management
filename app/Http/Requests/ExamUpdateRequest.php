<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
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
            'name' => 'required|min:4|unique:classes,name,' . $this->route('parent'), 
            'date' => 'required',
            'classe_id' => 'required',
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
            'name.unique' => 'Ce nom est déjà pris.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être "activer" ou "desactiver".',
        ];
    }
}
