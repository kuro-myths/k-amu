<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::where('leader_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('leader.proyek.index', ['projects' => $projects]);
    }

    public function create(): View
    {
        return view('leader.proyek.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:planning,in_progress,completed,on_hold',
        ]);

        $validated['leader_id'] = auth()->id();
        Project::create($validated);

        return redirect()->route('leader.proyek')->with('success', 'Proyek berhasil dibuat');
    }

    public function edit(Project $project): View
    {
        $this->authorize('update', $project);
        return view('leader.proyek.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:planning,in_progress,completed,on_hold',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $project->update($validated);

        return redirect()->route('leader.proyek')->with('success', 'Proyek berhasil diperbarui');
    }

    public function destroy(Project $project): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('leader.proyek')->with('success', 'Proyek berhasil dihapus');
    }
}
