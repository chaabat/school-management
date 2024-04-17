<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TeachersController extends Controller
{
    public function index(){
        
        return view('teacher.dashboard');
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
    
}
