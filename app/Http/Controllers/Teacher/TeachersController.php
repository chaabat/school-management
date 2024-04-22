<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class TeachersController extends Controller
{
    public function index(){
         
        $teacher = Auth::user();
        
        $classe = $teacher->teacherToClasse()->first();  
    
        if($classe) {
            $className = $classe->classe->name;
            $subjectCount = $classe->classe->subjectToClass->count();
            $examCount = $classe->classe->exam->count();
            $studentCount = $classe->classe->user->count();
        } else {
            $className = 'No Class found';
            $subjectCount = 0;
            $examCount = 0;
            $studentCount = 0;
        }
    
        return view('teacher.dashboard', compact('className', 'subjectCount', 'examCount', 'studentCount',));
    }
    
    
    public function administration() {
        $certificate = $this->download();
        return view('teacher.administration', compact('certificate'));
    }

    public function myClasse(){
        $teacher = Auth::user();
        $absences = Absence::where('user_id', $teacher->id)->get(); 
        $teacherClasses = $teacher->teacherToClasse()->with('classe')->paginate(1);
        return view('teacher.myClasse',compact('teacherClasses','absences'));
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

public function addAbsence(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'date' => 'required|date',
        'statut' => 'required|in:present,absent',
    ]);

    $user_id = $validatedData['user_id'];
    $date = $validatedData['date'];
    $statut = $validatedData['statut'];

     
    $absence = Absence::where('user_id', $user_id)
                      ->where('date', $date)
                      ->first();

  
    if ($absence) {
        $absence->update(['statut' => $statut]);
        $message = 'Absence updated successfully.';
    } else {
       
        Absence::create($validatedData);
        $message = 'Absence recorded successfully.';
    }

    return response()->json(['success' => true, 'message' => $message]);
}



 
    
}

 
