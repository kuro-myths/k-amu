<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserManagementController extends Controller
{
    public function pengguna(): View
    {
        $users = User::when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%');
        })
            ->when(request('role'), function ($query) {
                $query->where('role', request('role'));
            })
            ->latest()
            ->paginate(15);

        return view('superadmin.manajemen.pengguna', ['users' => $users]);
    }

    public function create(): View
    {
        return view('superadmin.manajemen.pengguna-form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:superadmin,mastercard,leader,user,tester',
            'user_type' => 'required|in:superadmin,mastercard,leader,siswa,orang_tua,alumni,tester',
            'level' => 'required|integer|min:1|max:10',
            'points' => 'nullable|integer|min:0',
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('superadmin.pengguna')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(User $user): View
    {
        return view('superadmin.manajemen.pengguna-form', ['user' => $user]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:superadmin,mastercard,leader,user,tester',
            'user_type' => 'required|in:superadmin,mastercard,leader,siswa,orang_tua,alumni,tester',
            'level' => 'required|integer|min:1|max:10',
            'points' => 'nullable|integer|min:0',
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('superadmin.pengguna')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('superadmin.pengguna')->with('success', 'Pengguna berhasil dihapus');
    }

    public function peran(): View
    {
        $users = User::with('roles')->get();
        return view('superadmin.manajemen.peran', ['users' => $users]);
    }

    public function catatanAktivitas(): View
    {
        $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(20);
        return view('superadmin.manajemen.catatan_aktivitas', ['logs' => $logs]);
    }
}
