<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Project;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * User Dashboard - Dinamis berdasarkan user_type
     */
    public function beranda(): View
    {
        $user = auth()->user();
        $notes = Note::where('user_id', $user->id)->count();
        $projects = Project::count();

        // Sesuaikan view berdasarkan user_type
        $viewPath = 'user.' . $user->user_type . '.beranda';

        if (!view()->exists($viewPath)) {
            $viewPath = 'user.beranda.index';
        }

        return view($viewPath, compact('user', 'notes', 'projects'));
    }

    /**
     * Notes
     */
    public function catatan(): View
    {
        $user = auth()->user();
        $notes = Note::where('user_id', $user->id)->latest()->paginate(10);

        return view('user.catatan.index', compact('notes'));
    }

    /**
     * Chat/Messages
     */
    public function obrolan(): View
    {
        return view('user.obrolan.index');
    }

    /**
     * Projects
     */
    public function proyek(): View
    {
        $projects = Project::latest()->paginate(10);

        return view('user.proyek.index', compact('projects'));
    }

    /**
     * Analysis & Learning Progress
     */
    public function analisis(): View
    {
        $user = auth()->user();

        return view('user.analisis.index', compact('user'));
    }

    /**
     * Profile
     */
    public function profil(): View
    {
        $user = auth()->user();

        return view('user.profil.index', compact('user'));
    }

    /**
     * Help/Bantuan
     */
    public function bantuan(): View
    {
        return view('user.bantuan.index');
    }
}
