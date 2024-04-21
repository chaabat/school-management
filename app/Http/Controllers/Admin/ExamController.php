<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Models\Classe;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\SubjetToClass;
use Illuminate\Http\Request;
 
use App\Services\examService;

class ExamController extends Controller
{
    public function __construct(protected examService $examService)
    {
    }

    public function index()
    {
        $exams = $this->examService->getAllExams(4);
        $classes = $this->examService->getActiveClasses(); 
        
        return view('admin.exam.exam', compact('exams', 'classes'));
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
       $exam = $request->validated();

       $this->examService->createExam($exam);

        return redirect()->route('exams.index')->with('success', 'Exam added successfully.');
    
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classes = $this->examService->getActiveClasses();
        $exam = $this->examService->getExamById($id);
        return view('admin.exam.update', compact('exam','classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamUpdateRequest $request, string $id)
    {
        $exams = $request->validated();
    
        $this->examService->updateExam($id, $exams);
 
    
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->examService->destroyExam($id);
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
