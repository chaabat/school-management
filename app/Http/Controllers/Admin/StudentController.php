<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->paginate(8);
        return view('admin/students/show',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/students/add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $student = $request->validate([
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


            $student['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $student = array_merge($student, ['picture' => $fileName]);

            $user = User::create($student);


            $user->student()->create();
            Auth::login($user);

            return redirect()->route('students.index');
        } catch (QueryException $e) {
            dd($student);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('admin/students/details', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        
        return view('admin/students/update',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $updateStudent = $request->validate([
            'name' => 'required|min:4|unique:users,name,' . $student->id,
            'email' => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|min:8',
            'phone' => 'required|min:8|max:10',
            'adress' => 'required',
            'date' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (isset($updateStudent['password'])) {
            $updateStudent['password'] = Hash::make($updateStudent['password']);
        }

        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $updateStudent['picture'] = $fileName;
        }

        $student->update($updateStudent);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
            