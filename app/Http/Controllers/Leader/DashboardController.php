<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $projects = \App\Models\Project::where('leader_id', auth()->id())->get();
        $teamCount = count(collect($projects)->pluck('team_members')->flatten()->unique());

        $stats = [
            'total_projects' => $projects->count(),
            'active_projects' => $projects->where('status', 'in_progress')->count(),
            'team_members' => $teamCount,
        ];

        return view('leader.beranda.index', ['stats' => $stats, 'projects' => $projects]);
    }
}
