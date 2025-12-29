<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $notes = $user->notes()->latest()->paginate(10);
        return view('user.' . $user->user_type . '.catatan.index', ['notes' => $notes]);
    }

    public function create(): View
    {
        /** @var User $user */
        $user = auth()->user();
        return view('user.' . $user->user_type . '.catatan.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        Note::create($validated);

        return redirect()->route('user.catatan')->with('success', 'Catatan berhasil dibuat');
    }

    public function edit(Note $note): View
    {
        $this->authorize('update', $note);
        return view('user.' . auth()->user()->user_type . '.catatan.edit', ['note' => $note]);
    }

    public function update(Request $request, Note $note): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string',
        ]);

        $note->update($validated);

        return redirect()->route('user.catatan')->with('success', 'Catatan berhasil diperbarui');
    }

    public function destroy(Note $note): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $note);
        $note->delete();

        return redirect()->route('user.catatan')->with('success', 'Catatan berhasil dihapus');
    }
}
