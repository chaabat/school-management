<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class LoginController extends Controller
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
    
            if ($user->role === 'admin') {
                $redirect = 'admin.dashboard';
            } elseif ($user->role === '') {
                $redirect = 'teacher.page';  
            } elseif ($user->role === 'student') {
                $redirect = 'student.page';  
            }elseif ($user->role === 'parent') {
                $redirect = 'parent.page';  
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
