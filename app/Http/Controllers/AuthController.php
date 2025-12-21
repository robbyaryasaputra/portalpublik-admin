<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login.login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|string',
        ], [
            'username.required' => 'Email wajib diisi.',
            'username.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password,
        ];


        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        session (['last_login' => now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i')]);


        return redirect()->intended(route('dashboard.index'));
    }

    return back()->withErrors(['credentials' => 'Email atau password salah'])->withInput();
}

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('login.form'); 
    }
}
