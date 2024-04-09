<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\subjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\RepositoriesInterfaces\subjectsRepositoryInterface;

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
        return view('admin.subject', compact('subjects'));
    }

   
    public function store(subjectRequest $request)
    {
        try {
            $class = $request->validated();

            $this->subjectRepository->createSubject($class);

            return redirect()->route('admin.subject');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

   
    public function update(UpdateSubjectRequest $request)
    {
        try {
            $class = $request->validated();
    
            $this->subjectRepository->updateSubject($request->id, $class);
    
            return redirect()->route('admin.subject');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    

   
    public function destroy(string $id)
    {
        $this->subjectRepository->destroySubject($id);

        return redirect()->route('admin.subject');
    }
}
