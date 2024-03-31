<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/admins/show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // Retrieve a single user by ID
        return view('admin.admins.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        try {
            $admin = $request->validate([
                'name' => 'required|min:4|unique:users,name,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:8',
                'phone' => 'required|min:8|max:10',
                'adress' => 'required',
                'date' => 'required',
                'role' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.min' => 'Le nom doit comporter plus de 4 caractères.',
                'name.unique' => 'Ce nom est déjà pris.',
                'email.required' => 'L\'adresse e-mail est obligatoire.',
                'email.email' => 'Structure d\'e-mail incorrecte.',
                'email.unique' => 'Cet e-mail est déjà utilisé.',
                'password.min' => 'Le mot de passe doit comporter plus de 8 caractères.',
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

            if (isset($admin['password'])) {
                $admin['password'] = Hash::make($admin['password']);
            }

            if ($request->hasFile('picture')) {
                $fileName = time() . '.' . $request->picture->extension();
                $request->picture->storeAs('users', $fileName);
                if ($user->picture) {
                    Storage::delete('users/' . $user->picture);
                }
                $admin = array_merge($admin, ['picture' => $fileName]);
            }

            $user->update($admin);

            return redirect()->route('admin.page')->with('success', 'Admin updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
