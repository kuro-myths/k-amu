<?php

namespace App\Http\Controllers\Tester;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $testResults = \App\Models\TestResult::where('tester_id', auth()->id())
            ->latest()
            ->limit(5)
            ->get();

        $stats = [
            'total_tests' => \App\Models\TestResult::where('tester_id', auth()->id())->count(),
            'passed_tests' => \App\Models\TestResult::where('tester_id', auth()->id())->where('status', 'passed')->count(),
            'failed_tests' => \App\Models\TestResult::where('tester_id', auth()->id())->where('status', 'failed')->count(),
            'level' => $user->level,
            'points' => $user->points,
        ];

        return view('tester.beranda.index', ['stats' => $stats, 'testResults' => $testResults]);
    }
}
