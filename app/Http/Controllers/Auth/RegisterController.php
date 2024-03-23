<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RegisterController extends Controller
{
    public function admin(Request $request)
    {
        try {
            $admin = $request->validate([
                'name' => 'required | min:4|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required | min:8 ',
                'phone' => 'required|min:8|max:10',
                'adress' => 'required',
                'date' => 'required',
                'role' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

            ],[
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
                'picture.image' => 'L\'image doit être un fichier image.',
                'picture.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif.',
                'picture.max' => 'L\'image ne doit pas dépasser 2048 kilo-octets.',
            ]);


            $admin['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $admin = array_merge($admin, ['picture' => $fileName]);

            $user = User::create($admin);


            $user->admin()->create();
            Auth::login($user);

            return redirect()->route('admin.page');
        } catch (QueryException $e) {
            dd($admin);
        }
    }
}
