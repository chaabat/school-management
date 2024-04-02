<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->paginate(8);
        return view('admin/teachers/show', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/teachers/add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $teacher = $request->validate([
                'name' => 'required | min:4|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required | min:8 ',
                'phone' => 'required|min:8|max:10',
                'adress' => 'required',
                'date' => 'required',
                // 'role' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

            ], [
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


            $teacher['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $teacher = array_merge($teacher, ['picture' => $fileName]);

            $user = User::create($teacher);


            $user->teacher()->create();
            Auth::login($user);

            return redirect()->route('teachers.index');
        } catch (QueryException $e) {
            dd($teacher);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin/teachers/details', compact('teacher'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin/teachers/update', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = User::findOrFail($id);

        $updateTeacher = $request->validate([
            'name' => 'required|min:4|unique:users,name,' . $teacher->id,
            'email' => 'required|email|unique:users,email,' . $teacher->id,
            'password' => 'nullable|min:8',
            'phone' => 'required|min:8|max:10',
            'adress' => 'required',
            'date' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (isset($updateTeacher['password'])) {
            $updateTeacher['password'] = Hash::make($updateTeacher['password']);
        }

        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $updateTeacher['picture'] = $fileName;
        }

        $teacher->update($updateTeacher);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
