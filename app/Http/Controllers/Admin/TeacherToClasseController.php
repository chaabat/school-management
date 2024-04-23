<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\teacherToClasseRequest;
use App\Http\Requests\updateTeacherToClasseRequest;
use Illuminate\Http\Request;
use App\Services\teacherToClasseService;

class TeacherToClasseController extends Controller
{

    public function __construct(protected teacherToClasseService $teacherToClasseService)
    {
    }
    public function index()
    {
        $classes = $this->teacherToClasseService->getAllClasses();
        $teachers = $this->teacherToClasseService->getAllTeachers();
        $teacherToClasse = $this->teacherToClasseService->getAllTeachersToClassPaginated(6);

        return view('admin.teacherToClasse.teacherToClasse', compact('classes', 'teachers', 'teacherToClasse'));
    }


    public function store(teacherToClasseRequest $request)
    {
        $teacherToClasse = $request->validated();

        $this->teacherToClasseService->create($teacherToClasse);


        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }

    public function edit($id)
    {
        $classes = $this->teacherToClasseService->getAllClasses();
        $teachers = $this->teacherToClasseService->getAllTeachers();
        $teacherToClasse = $this->teacherToClasseService->teacherToClassID($id);
    
        return view('admin.teacherToClasse.update', compact('teachers','classes','teacherToClasse'));
    }
  
    public function update(UpdateTeacherToClasseRequest $request, $id)
    {
        $teacherToClasse = $request->validated();
        
        
        $this->teacherToClasseService->update($teacherToClasse, $id);
        
        return redirect()->route('teacher-to-class.index')->with('success', 'Teacher-to-class relationship updated successfully');
    }

   


    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $results = $this->teacherToClasseService->search($searchQuery);
        return response()->json($results);
    }



    public function destroy($id)
    {
        $this->teacherToClasseService->delete($id);

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}