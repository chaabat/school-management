<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;



class StudentsController extends Controller
{
    public function index(){
        $student = auth()->user();

        $classe = $student->classe()
            ->withCount( 'exam')
            ->get(['id', 'name']);  

        return view('student.dashboard', compact('classe'));
    }

    public function administration() {
        $certificate = $this->download();
        return view('student.administration', compact('certificate'));
    }

    public function mySubject()
    {
        $student = Auth::user();  
        $classes = $student->classe()->with(['exam' => function ($query) {
            $query->where('date', '>=', now()->format('Y-m-d'));
         }])->get();
    
         
        $absences = $student->absences()->where('statut', 'absent')->get();
        
        $previousExams = Exam::where('date', '<', now()->format('Y-m-d'))->get(); 
        
        return view('student.mySubject', compact('classes', 'absences', 'previousExams'));
    }
    


    public function myTimeTable()
    {
        $student = Auth::user();  
        $classeTable = $student->classe()->with('timetable')->get();

        return view('student.myTimeTable', compact('classeTable'));
    }

    

    private function download()
    {
        $student = auth()->user();
    
         
        $lastDownloadDate = $student->download_date;
        $differenceInDays = $lastDownloadDate ? Carbon::now()->diffInDays($lastDownloadDate) : 7;
    
        return $differenceInDays >= 7;
    }
    


public function downloadCertificate()
{
    $student = auth()->user();
    $student->download_date = now();
    $student->save();

    $pdf = PDF::loadView('student.certificate', compact('student'));
    return $pdf->download('Attestation_de_scolarité.pdf');
}


}
