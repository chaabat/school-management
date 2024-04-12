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
}
