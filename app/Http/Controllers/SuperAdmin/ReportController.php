<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\BugReport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    public function index(): View
    {
        $totalUsers = \App\Models\User::count();
        $newUsersThisMonth = \App\Models\User::where('created_at', '>=', now()->startOfMonth())->count();
        $totalProjects = \App\Models\Project::count();
        $activeProjects = \App\Models\Project::where('status', 'in_progress')->count();
        $totalBugs = BugReport::count();
        $openBugs = BugReport::where('status', 'open')->count();
        $totalTests = \App\Models\TestResult::count();
        $passRate = $totalTests > 0 ? round((\App\Models\TestResult::where('status', 'passed')->count() / $totalTests) * 100) : 0;
        $activityLogs = \App\Models\ActivityLog::latest()->limit(10)->get();

        return view('superadmin.laporan.index', [
            'totalUsers' => $totalUsers,
            'newUsersThisMonth' => $newUsersThisMonth,
            'totalProjects' => $totalProjects,
            'activeProjects' => $activeProjects,
            'totalBugs' => $totalBugs,
            'openBugs' => $openBugs,
            'totalTests' => $totalTests,
            'passRate' => $passRate,
            'activityLogs' => $activityLogs,
        ]);
    }

    public function penggunaan(): View
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'active_users' => \App\Models\User::where('last_login_at', '>=', now()->subDays(30))->count(),
            'total_projects' => \App\Models\Project::count(),
            'total_bugs' => BugReport::count(),
        ];

        return view('superadmin.laporan.penggunaan', ['stats' => $stats]);
    }

    public function bug(): View
    {
        $bugs = BugReport::with(['reporter', 'assignedTo'])
            ->latest()
            ->paginate(20);

        return view('superadmin.laporan.bug', ['bugs' => $bugs]);
    }

    public function analisis(): View
    {
        $bugsByStatus = BugReport::groupBy('status')->selectRaw('status, count(*) as total')->get();
        $bugsBySeverity = BugReport::groupBy('severity')->selectRaw('severity, count(*) as total')->get();
        $usersByRole = \App\Models\User::groupBy('role')->selectRaw('role, count(*) as total')->get();

        return view('superadmin.laporan.analisis', [
            'bugsByStatus' => $bugsByStatus,
            'bugsBySeverity' => $bugsBySeverity,
            'usersByRole' => $usersByRole,
        ]);
    }
}
