<?php

namespace App\Http\Controllers\SuperAdmin;

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
        $notes = $user->notes()
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('content', 'like', '%' . request('search') . '%');
            })
            ->when(request('category'), function ($query) {
                $query->where('category', request('category'));
            })
            ->orderBy('is_pinned', 'desc')
            ->latest()
            ->paginate(10);

        return view('superadmin.catatan.index', ['notes' => $notes]);
    }

    public function create(): View
    {
        return view('superadmin.catatan.catatan-form');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category' => 'required|in:pribadi,pekerjaan,ide,ingatkan,lainnya',
            'color' => 'required|in:yellow,blue,green,pink,purple',
            'is_pinned' => 'nullable|boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_pinned'] = $request->has('is_pinned');
        Note::create($validated);

        return redirect()->route('superadmin.catatan')->with('success', 'Catatan berhasil dibuat');
    }

    public function edit(Note $note): View
    {
        $this->authorize('update', $note);
        return view('superadmin.catatan.catatan-form', ['note' => $note]);
    }

    public function update(Request $request, Note $note): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category' => 'required|in:pribadi,pekerjaan,ide,ingatkan,lainnya',
            'color' => 'required|in:yellow,blue,green,pink,purple',
            'is_pinned' => 'nullable|boolean',
        ]);

        $validated['is_pinned'] = $request->has('is_pinned');
        $note->update($validated);

        return redirect()->route('superadmin.catatan')->with('success', 'Catatan berhasil diperbarui');
    }

    public function destroy(Note $note): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $note);
        $note->delete();

        return redirect()->route('superadmin.catatan')->with('success', 'Catatan berhasil dihapus');
    }
}
