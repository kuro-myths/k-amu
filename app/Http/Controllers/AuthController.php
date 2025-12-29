<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===== LOGIN =====
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'superadmin') {
                return redirect()->route('superadmin.beranda');
            } elseif ($user->role === 'mastercard') {
                return redirect()->route('mastercard.beranda');
            } elseif ($user->role === 'leader') {
                return redirect()->route('leader.beranda');
            } elseif ($user->role === 'tester') {
                return redirect()->route('tester.beranda');
            } else {
                // user role
                return redirect()->route('user.beranda');
            }
        }

        return back()->with('error', 'Email atau password salah');
    }    // ===== REGISTER =====
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'user_type' => 'siswa',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login');
    }

    // ===== LOGOUT =====
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}
