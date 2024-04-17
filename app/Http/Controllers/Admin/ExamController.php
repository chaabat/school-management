<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\RepositoriesInterfaces\examRepositoryInterface;


class ExamController extends Controller
{
    private $examRepository;

    public function __construct(examRepositoryInterface $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function index()
    {
        
        $exams = $this->examRepository->getAllExams(4);
       return view('admin.exam.exam',compact('exams'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
       $exam = $request->validated();

       $this->examRepository->createExam($exam);

        return redirect()->route('exams.index')->with('success', 'Exam added successfully.');
    
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $exam = $this->examRepository->getExamById($id);
        return view('admin.exam.update', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamUpdateRequest $request, string $id)
    {
        $exams = $request->validated();
    
        $this->examRepository->updateExam($id, $exams);
 
    
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->examRepository->destroyExam($id);
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');

    }


    public function search(Request $request)
    {
        $search = $request->input('search');
    
        $exams = Exam::where('name', 'LIKE', "%$search%")
                     ->get();
    
        return response()->json($exams);
    }
}
