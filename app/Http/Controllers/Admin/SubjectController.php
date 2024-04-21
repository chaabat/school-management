<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\subjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Services\subjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(protected subjectService $subjectService)
    {
    }

    public function index()
    {
        $subjects = $this->subjectService->getAllSubjects(8);
        return view('admin.subject.subject', compact('subjects'));
    }

   
    public function store(subjectRequest $request)
    {
        
            $class = $request->validated();

            $this->subjectService->createSubject($class);

            return redirect()->route('subjects.index');
       
    }

    public function edit($id)
    {
        $subject = $this->subjectService->getSubjectById($id);
    
        return view('admin.subject.update', compact('subject'));
    }
 
    public function update(UpdateSubjectRequest $request, $id)
    {
        $subjectData = $request->validated();
        
        $this->subjectService->updateSubject($id, $subjectData);
        
        return redirect()->route('subjects.index')->with('success', 'Classe modifiée avec succès');
    }
    

   
    public function destroy(string $id)
    {
        $this->subjectService->destroySubject($id);

        return redirect()->route('subjects.index');
    }
    

    public function search(Request $request)
    {
        $query = $request->input('search');
        $subjects = $this->subjectService->searchSubjects($query);

        return response()->json($subjects);
    }
}
