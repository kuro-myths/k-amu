<?php

namespace App\Http\Controllers\Mastercard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        return view('mastercard.profil.index', ['user' => $user]);
    }

    public function edit(): View
    {
        $user = auth()->user();
        return view('mastercard.profil.edit', ['user' => $user]);
    }

    public function update(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->update($validated);

        return redirect()->route('mastercard.profil')->with('success', 'Profil berhasil diperbarui');
    }
}
