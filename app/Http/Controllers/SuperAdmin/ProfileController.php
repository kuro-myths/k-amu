<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        return view('superadmin.profil.index', ['user' => $user]);
    }

    public function edit(): View
    {
        $user = auth()->user();
        return view('superadmin.profil.edit', ['user' => $user]);
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'cv' => 'nullable|url',
        ]);

        /** @var User $user */
        $user = auth()->user();
        $user->update($validated);

        return redirect()->route('superadmin.profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function changePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = auth()->user();
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password'])
        ]);

        return redirect()->route('superadmin.profil')->with('success', 'Password berhasil diubah');
    }
}
