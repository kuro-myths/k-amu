<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();
        $totalBugs = \App\Models\BugReport::count();
        $totalProjects = \App\Models\Project::count();
        $totalTestResults = \App\Models\TestResult::count();

        return view('superadmin.beranda.index', [
            'totalUsers' => $totalUsers,
            'totalBugs' => $totalBugs,
            'totalProjects' => $totalProjects,
            'totalTestResults' => $totalTestResults,
        ]);
    }
}
