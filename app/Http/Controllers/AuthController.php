<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(123456));
        if (!empty(Auth::check()))
        {
            if(Auth::user()->role == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->role == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->role == 3)
            {
                return redirect('student/dashboard');
            }
        }

        return view('auth.sign-in');
    }

    public function AuthLogin(Request $request)
    {
        $remember = empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->role == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->role == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->role == 3)
            {
                return redirect('student/dashboard');
            }
        }
        else
        {
            return redirect()->back()->with("error", "Please enter correct email and password");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url('sign-in'));
    }
}
