<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\teacherRequest;
use App\Http\Requests\UpdateteacherRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
 
 use App\Services\teacherService;

class TeacherController extends Controller
{
    public function __construct(protected teacherService $teacherService)
    {
    }

    public function index()
    {
        $teachers = $this->teacherService->getAllTeachers(8);

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
    public function store(teacherRequest $request)
    {

        try {
            $teacher = $request->validated();


            $teacher['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $teacher = array_merge($teacher, ['picture' => $fileName]);

            $user = $this->teacherService->createTeacher($teacher);

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
        $teacher = $this->teacherService->getTeacherById($id);
        return view('admin/teachers/details', compact('teacher'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = $this->teacherService->getTeacherById($id);
        return view('admin/teachers/update', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateteacherRequest $request, $id)
    {
        $teacher = $this->teacherService->getTeacherById($id);
    
        $updateTeacher = $request->validated();
    
        if (isset($updateTeacher['password'])) {
            $updateTeacher['password'] = Hash::make($updateTeacher['password']);
        }
    
        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $updateTeacher['picture'] = $fileName;
        }
    
        
        $this->teacherService->updateTeacher($id, $updateTeacher);
    
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = $this->teacherService->getTeacherById($id);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $teachers = $this->teacherService->searchTeachers($search);

        return response()->json($teachers);
    }

  
}
