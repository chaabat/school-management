<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class StudentsController extends Controller
{
    public function index(){
        return view('student.dashboard');
    }
    public function administration() {
        $canDownloadCertificate = $this->canDownloadCertificate();
        return view('student.administration', compact('canDownloadCertificate'));
    }

    public function mySubject(){
        $student = Auth::user();  
        $classes = $student->classe()->get();

    return view('student.mySubject', compact('classes'));
    }

    public function myTimeTable()
    {
        $student = Auth::user();  
        $classeTable = $student->classe()->with('timetable')->get();

        return view('student.myTimeTable', compact('classeTable'));
    }

    

    private function canDownloadCertificate()
    {
        $student = auth()->user();
    
        // Check if the download_date attribute is null or if it's been more than a week since the last download
        $lastDownloadDate = $student->download_date;
        $differenceInDays = $lastDownloadDate ? Carbon::now()->diffInDays($lastDownloadDate) : 7;
    
        return $differenceInDays >= 7;
    }
    


public function downloadCertificate()
{
    $student = auth()->user();

    // Update the last download date to the current date
    $student->download_date = now();
    $student->save();

    // Load the certificate PDF and return the download response
    $pdf = PDF::loadView('student.certificate', compact('student'));
    return $pdf->download('certificate.pdf');
}


}
