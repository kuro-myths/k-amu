<?php

namespace App\Http\Controllers\Mastercard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_accounts_created' => \App\Models\User::whereDate('created_at', today())->count(),
            'active_users' => \App\Models\User::where('last_login_at', '>=', now()->subDays(7))->count(),
        ];

        return view('mastercard.beranda.index', ['stats' => $stats]);
    }
}
