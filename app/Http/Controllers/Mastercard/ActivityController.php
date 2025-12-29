<?php

namespace App\Http\Controllers\Mastercard;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('mastercard.catatan_aktivitas', ['logs' => $logs]);
    }
}
