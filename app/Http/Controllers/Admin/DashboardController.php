<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Exam;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;

class DashboardController extends Controller
{


    public function dashboard()
    {
        $teacherRole = Role::where('name', 'teacher')->first();
        $teachers = User::where('role_id', $teacherRole->id)->count();

        $studentRole = Role::where('name', 'student')->first();
        $students = User::where('role_id', $studentRole->id)->count();

        $parentRole = Role::where('name', 'parent')->first();
        $parents = User::where('role_id', $parentRole->id)->count();


        $classes = Classe::count();
        $subjects = Subject::count();
        $exams = Exam::count();


        
       
        return view('admin.dashboard', compact('teachers', 'classes', 'subjects', 'exams','parents','students'));
    }

     
    
    

  

   
}
