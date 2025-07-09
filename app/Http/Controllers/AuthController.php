<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
{
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('dashboard.dashboard-login');
}

    public function login(Request $request)
{
    // Ubah validasi untuk mencari 'username'
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required'],
    ]);

    // Auth::attempt akan secara otomatis mencocokkan dengan kolom 'username'
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors([
        'username' => 'Username atau password yang diberikan salah.',
    ])->onlyInput('username');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
