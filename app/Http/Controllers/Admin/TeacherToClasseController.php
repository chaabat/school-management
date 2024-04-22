<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\teacherToClasseRequest;
use App\Http\Requests\updateTeacherToClasseRequest;
use Illuminate\Http\Request;
use App\RepositoriesInterfaces\teacherToClasseRepositoryInterface;



class TeacherToClasseController extends Controller
{

    private $teacherToClassRepository;

    public function __construct(teacherToClasseRepositoryInterface $teacherToClassRepository)
    {
        $this->teacherToClassRepository = $teacherToClassRepository;
    }
    public function index()
    {
        $classes = $this->teacherToClassRepository->getAllClasses();
        $teachers = $this->teacherToClassRepository->getAllTeachers();
        $teacherToClasse = $this->teacherToClassRepository->getAllTeachersToClassPaginated(6);

        return view('admin.teacherToClasse.teacherToClasse', compact('classes', 'teachers', 'teacherToClasse'));
    }


    public function store(teacherToClasseRequest $request)
    {
        $teacherToClasse = $request->validated();

        $this->teacherToClassRepository->create($teacherToClasse);


        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }

    public function edit($id)
    {
        $classes = $this->teacherToClassRepository->getAllClasses();
        $teachers = $this->teacherToClassRepository->getAllTeachers();
        $teacherToClasse = $this->teacherToClassRepository->teacherToClassID($id);
    
        return view('admin.teacherToClasse.update', compact('teachers','classes','teacherToClasse'));
    }
  
    public function update(UpdateTeacherToClasseRequest $request, $id)
    {
        $teacherToClasse = $request->validated();
        
        
        $this->teacherToClassRepository->update($teacherToClasse, $id);
        
        return redirect()->route('teacher-to-class.index')->with('success', 'Teacher-to-class relationship updated successfully');
    }

   


    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $results = $this->teacherToClassRepository->search($searchQuery);
        return response()->json($results);
    }



    public function destroy($id)
    {
        $this->teacherToClassRepository->delete($id);

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}