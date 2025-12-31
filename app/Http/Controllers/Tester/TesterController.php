<?php

namespace App\Http\Controllers\Tester;

use App\Http\Controllers\Controller;
use App\Models\BugReport;
use App\Models\TestResult;
use App\Models\Note;
use Illuminate\View\View;

class TesterController extends Controller
{
    /**
     * Tester Dashboard
     */
    public function beranda(): View
    {
        $user = auth()->user();
        $totalBugs = BugReport::where('reporter_id', $user->id)->count();
        $totalTests = TestResult::where('tester_id', $user->id)->count();
        $notes = Note::where('user_id', $user->id)->count();

        return view('tester.beranda.index', compact('totalBugs', 'totalTests', 'notes'));
    }

    /**
     * Bug Reports / Tools
     */
    public function laporan(): View
    {
        $user = auth()->user();
        $bugs = BugReport::where('reporter_id', $user->id)->latest()->paginate(10);

        return view('tester.laporan.index', compact('bugs'));
    }

    /**
     * Tools / Bug Create
     */
    public function toolsCreate(): View
    {
        return view('tester.laporan.create');
    }

    /**
     * Test Results
     */
    public function tools(): View
    {
        $user = auth()->user();
        $testResults = TestResult::where('tester_id', $user->id)->latest()->paginate(10);

        return view('tester.tools.index', compact('testResults'));
    }

    /**
     * Analysis & Reports
     */
    public function analisis(): View
    {
        $user = auth()->user();
        $totalTests = TestResult::where('tester_id', $user->id)->count();
        $passedTests = TestResult::where('tester_id', $user->id)->where('status', 'passed')->count();
        $failedTests = TestResult::where('tester_id', $user->id)->where('status', 'failed')->count();
        $passRate = $totalTests > 0 ? round(($passedTests / $totalTests) * 100) : 0;

        return view('tester.analisis.index', compact('totalTests', 'passedTests', 'failedTests', 'passRate'));
    }

    /**
     * Notes
     */
    public function catatan(): View
    {
        $user = auth()->user();
        $notes = Note::where('user_id', $user->id)->latest()->paginate(10);

        return view('tester.catatan.index', compact('notes'));
    }

    /**
     * Chat/Messages
     */
    public function obrolan(): View
    {
        return view('tester.obrolan.index');
    }

    /**
     * Profile
     */
    public function profil(): View
    {
        $user = auth()->user();

        return view('tester.profil.index', compact('user'));
    }

    /**
     * Help/Bantuan
     */
    public function bantuan(): View
    {
        return view('tester.bantuan.index');
    }
}
