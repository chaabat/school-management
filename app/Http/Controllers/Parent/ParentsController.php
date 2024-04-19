<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    public function index(){
        return view('parent.dashboard');
    }

    public function myChildren() {
        $parent = Auth::user();  
        $children = $parent->children()->get(); 
        return view('parent.myChildrens',compact('children'));
    }


    public function myChildrenSubjects($id)
    {
        $child = User::findOrFail($id);
    
        // Fetch upcoming exams for the child's classes
        $upcomingExams = $child->classe()->with(['exam' => function ($query) {
            $query->where('date', '>=', now()->format('Y-m-d'));
        }])->get();
    
        // Fetch previous exams for the child's classes
        $previousExams = $child->classe()->with(['exam' => function ($query) {
            $query->where('date', '<', now()->format('Y-m-d'));
        }])->get();
    
        // Fetch classes and timetable for the child
        $classeTable = $child->classe()->with('timetable')->get();
        $classes = $child->classe()->with('subjectToClass.subject')->get();
    
        return view('parent.classeSubjects', compact('child', 'classes', 'classeTable', 'upcomingExams', 'previousExams'));
    }
    

    




   
}
