<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TeachersController extends Controller
{
    public function index(){
        
        return view('teacher.dashboard');
    }

    public function administration() {
        $certificate = $this->download();
        return view('teacher.administration', compact('certificate'));
    }

    public function myClasse(){
        $user = Auth::user();
        $teacherClasses = $user->teacherToClasse()->with('classe')->paginate(1);
        return view('teacher.myClasse',compact('teacherClasses'));
    }
    public function myTimeTable()
    {
         
        $user = Auth::user();
        
      
        $teacherTable = $user->teacherToClasse()->with('classe.timetable')->paginate(1);
        
        return view('teacher.myTimeTable', compact('teacherTable'));
    }

    private function download()
    {
        $teacher = auth()->user();
    
         
        $lastDownloadDate = $teacher->download_date;
        $differenceInDays = $lastDownloadDate ? Carbon::now()->diffInDays($lastDownloadDate) : 7;
    
        return $differenceInDays >= 7;
    }
    


public function downloadCertificate()
{
    $teacher = auth()->user();
    $teacher->download_date = now();
    $teacher->save();

    $pdf = PDF::loadView('teacher.certificate', compact('teacher'));
    return $pdf->download('Attestation_de_travaille.pdf');
}
 
    
}
