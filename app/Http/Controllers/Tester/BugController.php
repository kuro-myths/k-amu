<?php

namespace App\Http\Controllers\Tester;

use App\Http\Controllers\Controller;
use App\Models\BugReport;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BugController extends Controller
{
    public function index(): View
    {
        $bugs = BugReport::with(['reporter', 'assignedTo'])
            ->latest()
            ->paginate(15);

        return view('tester.tools.index', ['bugs' => $bugs]);
    }

    public function create(): View
    {
        return view('tester.tools.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'category' => 'nullable|string',
            'steps_to_reproduce' => 'nullable|json',
        ]);

        $validated['reporter_id'] = auth()->id();
        BugReport::create($validated);

        return redirect()->route('tester.tools')->with('success', 'Bug report berhasil dibuat');
    }

    public function show(BugReport $bug): View
    {
        return view('tester.tools.show', ['bug' => $bug]);
    }

    public function edit(BugReport $bug): View
    {
        $this->authorize('update', $bug);
        return view('tester.tools.edit', ['bug' => $bug]);
    }

    public function update(Request $request, BugReport $bug): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $bug);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'category' => 'nullable|string',
            'status' => 'required|in:open,in_progress,resolved,closed,reopened',
        ]);

        $bug->update($validated);

        return redirect()->route('tester.tools')->with('success', 'Bug report berhasil diperbarui');
    }
}
