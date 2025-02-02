<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login() 
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $creadentials = $request->only('email', 'password');

        // memproses login
        if (Auth::attempt($creadentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('siswa.index');
        }

        return redirect()->back()->with([
            'message' => 'Email atau password salah'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
