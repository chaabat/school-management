<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function course()
    {
        return view('admin/subject');
    }

    public function subjectToClass()
    {
        return view('admin/subjectToClass');
    }
}
