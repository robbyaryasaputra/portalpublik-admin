<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('pages.login.login-form');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input. Form saat ini menggunakan field 'username' — kita anggap sebagai email.
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

        session(['last_login' => now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i')]);
        // -------------------------------------------

        return redirect()->intended(route('dashboard.index'));
    }

    return back()->withErrors(['credentials' => 'Email atau password salah'])->withInput();
}

    public function logout(Request $request)
    {
        Auth::logout(); // Log out user
        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regenerate CSRF token untuk keamanan
        return redirect()->route('login.form'); // Arahkan kembali ke halaman login
    }
}
