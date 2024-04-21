<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\studentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Services\studentService;

class StudentController extends Controller
{
    public function __construct(protected studentService $studentService)
    {
    }

    public function index()
    {
        $students = $this->studentService->getAllStudents(8);

        return view('admin/students/show', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = $this->studentService->getActiveClasses();
        $parents = $this->studentService->getParents();
        return view('admin.students.add', compact('parents', 'classes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(studentRequest $request)
    {

      
            $student = $request->validated();

            $student['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $student = array_merge($student, ['picture' => $fileName]);
            
            $user = $this->studentService->createStudent($student);
           
            Auth::login($user);

            return redirect()->route('students.index');
        
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->getStudentWithParent($id);
        $child = $student;
        $parent = $student->parent;
        return view('admin/students/details', compact('student', 'parent', 'child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $classes = $this->studentService->getActiveClasses();
    $parents = $this->studentService->getParents();
    $student = $this->studentService->getStudentById($id);
    return view('admin.students.update', compact('student', 'parents', 'classes'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentRequest $request, $id)
    {
        $student = $this->studentService->getStudentById($id);

        $updateStudent = $request->validated();

        if (isset($updateStudent['password'])) {
            $updateStudent['password'] = Hash::make($updateStudent['password']);
        }

        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $updateStudent['picture'] = $fileName;
        }


        $this->studentService->updateStudent($id, $updateStudent);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $this->studentService->destroyStudent($id);
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $students = $this->studentService->searchStudents($search);

        return response()->json($students);
    }

    public function myParent($id)
    {
        $child = User::find($id);
        $parent = $child->parent;


        return view('admin.students.studentParent', compact('parent', 'child'));
    }
}
