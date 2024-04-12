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
        // Retrieve the child's information
        $child = User::findOrFail($id);

        // Retrieve the classes associated with the child
        $classes = $child->classe()->with('subjectToClass.subject')->get();

        return view('parent.classeSubjects', compact('child', 'classes'));
    }




   
}
