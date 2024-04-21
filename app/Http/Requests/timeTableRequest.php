<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class timeTableRequest extends FormRequest
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
            'classe_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'days' => 'required|in:monday,tuesday,wednesday,thursday,friday',
            'time' => 'required|regex:/^\d{2}:\d{2}$/'
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
            'subject_id.unique' => 'The subject is already assigned to a timetable',
            'classe_id.unique' => 'The classe is already assigned to a timetable.',
        ];
    }
}
