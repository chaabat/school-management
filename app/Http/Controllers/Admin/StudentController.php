<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\studentRequest;
use App\Http\Requests\UpdatestudentRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\RepositoriesInterfaces\studentRepositoryInterface;

class StudentController extends Controller
{
    private $studentRepository;

    public function __construct(studentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $students = $this->studentRepository->getAllStudents(8);

        return view('admin/students/show', compact('students'));
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
    public function store(studentRequest $request)
    {

        try {
            $student = $request->validated();


            $student['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $student = array_merge($student, ['picture' => $fileName]);

            $user = $this->studentRepository->createStudent($student);
            Auth::login($user);

            return redirect()->route('students.index');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentRepository->getStudentById($id);
        return view('admin/students/details', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = $this->studentRepository->getStudentById($id);

        return view('admin/students/update', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentRequest $request, $id)
    {
        $student = $this->studentRepository->getStudentById($id);
    
        $updateStudent = $request->validated();
    
        if (isset($updateStudent['password'])) {
            $updateStudent['password'] = Hash::make($updateStudent['password']);
        }
    
        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $updateStudent['picture'] = $fileName;
        }
    
        
        $this->studentRepository->updateStudent($id, $updateStudent);
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = $this->studentRepository->getStudentById($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $students = $this->studentRepository->searchStudents($search);

        return response()->json($students);
    }
}