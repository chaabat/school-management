<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class AuthentificationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function resetPassword($token)
    {
        return view("auth.reset-password", compact('token'));
    }

    public function forgotPassword()
    {
        return view("auth.forgot-password");
    }

    public function waitPage()
    {
        return view('auth.waitPage');
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
                $redirect = 'teacherDashboard';
            } elseif ($role === 'student') {
                $redirect = 'studentDashboard';
            } elseif ($role === 'parent') {
                $redirect = 'parentDashboard';
            }

            return redirect()->route($redirect);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        $existingToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if ($existingToken) {
          
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
             
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        Mail::send(
            "auth.sendForgotEmail",
            ['token' => $token],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Reset Password");
            }
        );

        return redirect()->to(route("waitPage"))
            ->with('success', 'We have sent an email to reset your password');
    }


    public function resetPasswordPost(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset', ['token' => $request->token]))
                ->with('error', 'invalid');
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        return view('auth.login')->with('success', 'password was reseted successfully');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function sendMessage(Request $request)
    {
         
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'role' => 'nullable',
            'message' => 'required|min:5, max:200',
        ]);

        // Send email
        Mail::to('smilemoreinfo@gmail.com')->send(new ContactFormMail($data));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
