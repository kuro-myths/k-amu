<?php

namespace App\Http\Controllers\Mastercard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function pengguna(): View
    {
        $users = User::paginate(15);
        return view('mastercard.manajemen.pengguna', ['users' => $users]);
    }

    public function akun(): View
    {
        return view('mastercard.manajemen.akun');
    }

    public function createAkun(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:leader,user,tester',
            'user_type' => 'nullable|in:siswa,orang_tua,alumni',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return back()->with('success', 'Akun berhasil dibuat');
    }
}
