<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthentificationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $redirect = 'login';

            $role = $user->role->name;

            if ($role === 'admin') {
                $redirect = 'admin.dashboard';
            } elseif ($role === 'teacher') {
                $redirect = 'teachers.index';
            } elseif ($role === 'student') {
                $redirect = 'students.index';
            } elseif ($role === 'parent') {
                $redirect = 'parents.index';
            }

            return redirect()->route($redirect);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }





    public function destroy(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('welcome');
    }
}

