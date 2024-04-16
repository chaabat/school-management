<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\subjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\RepositoriesInterfaces\subjectsRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $subjectRepository;

    public function __construct(subjectsRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->getAllSubjects(8);
        return view('admin.subject.subject', compact('subjects'));
    }

   
    public function store(subjectRequest $request)
    {
        
            $class = $request->validated();

            $this->subjectRepository->createSubject($class);

            return redirect()->route('admin.subject');
       
    }

    public function edit($id)
    {
        $subject = $this->subjectRepository->getSubjectById($id);
    
        return view('admin.subject.update', compact('subject'));
    }
 
    public function update(UpdateSubjectRequest $request, $id)
    {
        $subjectData = $request->validated();
        
        $this->subjectRepository->updateSubject($id, $subjectData);
        
        return redirect()->route('admin.subject')->with('success', 'Classe modifiée avec succès');
    }
    

   
    public function destroy(string $id)
    {
        $this->subjectRepository->destroySubject($id);

        return redirect()->route('admin.subject');
    }
    

    public function search(Request $request)
    {
        $query = $request->input('search');
        $subjects = $this->subjectRepository->searchSubjects($query);

        return response()->json($subjects);
    }
}
