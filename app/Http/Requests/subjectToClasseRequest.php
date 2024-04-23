<?php

namespace App\Http\Requests;

use App\Models\SubjetToClass;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class subjectToClasseRequest extends FormRequest
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
            'subject_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = SubjetToClass::where('classe_id', $this->classe_id)
                        ->where('subject_id', $value)
                        ->exists();
    
                    if ($exists) {
                        $fail('The selected subject is already associated with this class.');
                    }
                },
            ],
            'statut' => 'required',
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
