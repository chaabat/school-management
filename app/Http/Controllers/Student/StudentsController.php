<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentsController extends Controller
{
    public function index(){
        return view('student.dashboard');
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
}
