<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use App\Models\Admin;
use App\Models\User;

class AdminPagesController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function course()
    {
        return view('admin/filiere');
    }

    public function class()
    {
        return view('admin/class');
    }


    public function admin()
    {
        $admins = User::where('role', 'admin')
            ->orderby('created_at', 'desc')
            ->paginate(4);
        return view('admin/admins/show', compact('admins'));
    }



    public function addAdmin()
    {
        return view('admin/admins/add');
    }

    public function updateAdmin($id)
    {

        $admin = User::findOrFail($id);
        return view('admin.admins.update', compact('admin'));
    }



    public function parent()
    {
        return view('admin/parents/show');
    }

    public function addParent()
    {
        return view('admin/parents/add');
    }

    public function updateParent()
    {
        return view('admin/parents/update');
    }







    public function teacher()
    {
        return view('admin/teachers/show');
    }

    public function addTeacher()
    {
        return view('admin/teachers/add');
    }

    public function updateTeacher()
    {
        return view('admin/teachers/update');
    }






    public function student()
    {
        return view('admin/students/show');
    }
    public function addStudent()
    {
        return view('admin/students/add');
    }

    public function updateStudent()
    {
        return view('admin/students/update');
    }
}
