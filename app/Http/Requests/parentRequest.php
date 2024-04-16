<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class parentRequest extends FormRequest
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
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required | min:4|unique:users,name',
            'date' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required | min:8 ',
            'adress' => 'required',
            'ville' => 'required',
            'genre' => 'required',
            'phone' => 'required|min:8',
            'description' => 'required',
            'role_id' => 'required',
           
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
            'name.min' => 'Le nom doit comporter plus de 4 caractères.',
            'name.unique' => 'Ce nom est déjà pris.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Structure d\'e-mail incorrecte.',
            'email.unique' => 'Cet e-mail est déjà utilisé.',
            'password.min' => 'Le mot de passe doit comporter plus de 8 caractères.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins 8 chiffres.',
            'phone.max' => 'Le numéro de téléphone doit comporter au maximum 10 chiffres.',
            'date.required' => 'La date est obligatoire.',
            'genre.required' => 'Le genre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'picture.required' => 'L\'image est obligatoire.',
            'picture.image' => 'L\'image doit être un fichier image.',
            'picture.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif.',
            'picture.max' => 'L\'image ne doit pas dépasser 2048 kilo-octets.',
        ];
    }
}
