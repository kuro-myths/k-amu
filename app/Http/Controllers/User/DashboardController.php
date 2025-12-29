<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $notes = $user->notes()->latest()->limit(5)->get();
        $notifications = $user->notifications()->unread()->latest()->limit(5)->get();

        return view('user.' . $user->user_type . '.beranda.index', [
            'user' => $user,
            'notes' => $notes,
            'notifications' => $notifications,
        ]);
    }
}
