<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\subjectToClasseRequest;
use App\Http\Requests\UpdateSubjectToClasseRequest;
use App\Models\Classe;
use App\Models\Subject;
use App\Models\SubjetToClass;
use Illuminate\Http\Request;
use App\RepositoriesInterfaces\subjectToClasseRepositoryInterface;
class SubjectToClasseController extends Controller
{

    private $subjectToClassRepository;

    public function __construct(subjectToClasseRepositoryInterface $subjectToClassRepository)
    {
        $this->subjectToClassRepository = $subjectToClassRepository;
    }

    public function index()
    {
        $classes = $this->subjectToClassRepository->getAllClasses();
        $subjects = $this->subjectToClassRepository->getAllSubjects();
        $subjetToClasse = $this->subjectToClassRepository->getAllSubjectToClassPaginated(6);
        return view('admin.subjectToClass.subjectToClass', compact('subjetToClasse', 'subjects', 'classes'));
    }

    public function store(subjectToClasseRequest $request)
    {
        $data = $request->validated();
    
         
        $this->subjectToClassRepository->create($data);
    
        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }

    public function edit($id)
    {
        $classes = $this->subjectToClassRepository->getAllClasses();
        $subjects = $this->subjectToClassRepository->getAllSubjects();
        $subjetToClasse = $this->subjectToClassRepository->subjetToClassID($id);
    
        return view('admin.subjectToClass.update', compact('subjects','classes','subjetToClasse'));
    }
  
    public function update(UpdateSubjectToClasseRequest $request, $id)
    {
        $subjectData = $request->validated();
        
        
        $this->subjectToClassRepository->update($subjectData, $id);
        
        return redirect()->route('subject-to-class.index')->with('success', 'Subject-to-class relationship updated successfully');
    }
    

    


    
    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $results = $this->subjectToClassRepository->search($searchQuery);
        return response()->json($results);
    }

    public function destroy($id)
    {
        $this->subjectToClassRepository->delete($id);

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}
