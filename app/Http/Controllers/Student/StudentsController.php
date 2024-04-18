<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class StudentsController extends Controller
{
    public function index()
    {
         
        $canDownloadCertificate = $this->canDownloadCertificate();

        return view('student.dashboard', compact('canDownloadCertificate'));
    }

     

    private function canDownloadCertificate()
    {
        $student = auth()->user();

       
        $lastDownloadDate = $student->last_download_date;
        $differenceInDays = Carbon::now()->diffInDays($lastDownloadDate);

        
        return $differenceInDays >= 7;
    }

    public function downloadCertificate()
    {
         
        $student = auth()->user();
        $student->update(['last_download_date' => now()]);

      
        $pdf = PDF::loadView('student.certificate', compact('student'));

        
        return $pdf->download('certificate.pdf');
    }
}
