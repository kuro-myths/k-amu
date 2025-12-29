<?php

namespace App\Http\Controllers\Tester;

use App\Http\Controllers\Controller;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestingController extends Controller
{
    public function laporan(): View
    {
        $results = TestResult::where('tester_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('tester.laporan.index', ['results' => $results]);
    }

    public function createResult(): View
    {
        return view('tester.laporan.create');
    }

    public function storeResult(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'feature_name' => 'required|string|max:255',
            'test_description' => 'nullable|string',
            'status' => 'required|in:in_progress,passed,failed,inconclusive',
            'percentage' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $validated['tester_id'] = auth()->id();
        TestResult::create($validated);

        return redirect()->route('tester.laporan')->with('success', 'Hasil test berhasil disimpan');
    }

    public function monitoring(): View
    {
        $bugs = \App\Models\BugReport::with(['reporter', 'assignedTo'])
            ->latest()
            ->paginate(20);

        $stats = [
            'total_bugs' => \App\Models\BugReport::count(),
            'open_bugs' => \App\Models\BugReport::where('status', 'open')->count(),
            'in_progress' => \App\Models\BugReport::where('status', 'in_progress')->count(),
            'resolved' => \App\Models\BugReport::where('status', 'resolved')->count(),
        ];

        return view('tester.monitoring.index', ['bugs' => $bugs, 'stats' => $stats]);
    }

    public function statistik(): View
    {
        $myTests = TestResult::where('tester_id', auth()->id())->count();
        $myPassed = TestResult::where('tester_id', auth()->id())->where('status', 'passed')->count();
        $myBugs = \App\Models\BugReport::where('reporter_id', auth()->id())->count();

        return view('tester.statistik.index', [
            'myTests' => $myTests,
            'myPassed' => $myPassed,
            'myBugs' => $myBugs,
        ]);
    }
}
