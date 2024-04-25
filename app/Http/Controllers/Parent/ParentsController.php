<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Services\paService;

class ParentsController extends Controller
{
    public function __construct(protected paService $paService)
    {
    }
    public function index()
    {
         
        $children = $this->paService->index();  
        return view('parent.dashboard', compact('children'));
    }

    public function administration()
    {
        return view('parent.administration');
    }

    public function myChildren()
    {
        $children = $this->paService->myChildren();  
        return view('parent.myChildrens', compact('children'));
    }

    public function myChildrenSubjects($id)
    {
        $upcomingExams = $this->paService->myChildrenSubjects($id)['upcomingExams'];
        $previousExams = $this->paService->myChildrenSubjects($id)['previousExams'];
        $classeTable = $this->paService->myChildrenSubjects($id)['classeTable'];
        $classes = $this->paService->myChildrenSubjects($id)['classes'];
        $children = $this->paService->myChildrenSubjects($id)['children'];

        return view('parent.classeSubjects', compact('upcomingExams', 'previousExams', 'classeTable', 'classes', 'children'));
    }
}
