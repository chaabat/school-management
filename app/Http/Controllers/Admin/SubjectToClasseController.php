<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\subjectToClasseRequest;
use App\Http\Requests\UpdateSubjectToClasseRequest;
use Illuminate\Http\Request;
use App\Services\subjectToClasseService;

class SubjectToClasseController extends Controller
{

    public function __construct(protected subjectToClasseService $subjectToClasseService)
    {
    }

    public function index()
    {
        $classes = $this->subjectToClasseService->getAllClasses();
        $subjects = $this->subjectToClasseService->getAllSubjects();
        $subjetToClasse = $this->subjectToClasseService->getAllSubjectToClassPaginated(6);
        return view('admin.subjectToClass.subjectToClass', compact('subjetToClasse', 'subjects', 'classes'));
    }

    public function store(subjectToClasseRequest $request)
    {
        $data = $request->validated();
    
         
        $this->subjectToClasseService->create($data);
    
        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }

    public function edit($id)
    {
        $classes = $this->subjectToClasseService->getAllClasses();
        $subjects = $this->subjectToClasseService->getAllSubjects();
        $subjetToClasse = $this->subjectToClasseService->subjetToClassID($id);
    
        return view('admin.subjectToClass.update', compact('subjects','classes','subjetToClasse'));
    }
  
    public function update(UpdateSubjectToClasseRequest $request, $id)
    {
        $subjectData = $request->validated();
        
        
        $this->subjectToClasseService->update($subjectData, $id);
        
        return redirect()->route('subject-to-class.index')->with('success', 'Subject-to-class relationship updated successfully');
    }
    


    
    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $results = $this->subjectToClasseService->search($searchQuery);
        return response()->json($results);
    }

    public function destroy($id)
    {
        $this->subjectToClasseService->delete($id);

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}
