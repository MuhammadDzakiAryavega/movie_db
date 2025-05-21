<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formlogin() 
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $creadentials = $request->validate([
            'email' => ['required|email'],
            'password' => 'required'
        ]);

        if(Auth::attempt($creadentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
                'email' => 'The provided credentials do not match our records'
            ])->onlyInput('email');
    }
}
