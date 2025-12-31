<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class LeaderController extends Controller
{
    /**
     * Leader Dashboard
     */
    public function beranda()
    {
        $user = Auth::user();
        $projects = Project::where('leader_id', $user->id)->count();
        $notes = Note::where('user_id', $user->id)->count();
        
        return view('leader.beranda.index', compact('projects', 'notes'));
    }

    /**
     * Project List
     */
    public function proyek()
    {
        $user = Auth::user();
        $projects = Project::where('leader_id', $user->id)->paginate(10);
        
        return view('leader.proyek.index', compact('projects'));
    }

    /**
     * Create Project
     */
    public function proyekCreate()
    {
        return view('leader.proyek.create');
    }

    /**
     * Project Details
     */
    public function proyekDetail($id)
    {
        $project = Project::findOrFail($id);
        
        // Check if user is the project leader
        if ($project->leader_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('leader.proyek.detail', compact('project'));
    }

    /**
     * Guidance List
     */
    public function bimbingan()
    {
        $user = Auth::user();
        
        return view('leader.bimbingan.index');
    }

    /**
     * Create Guidance
     */
    public function bimbinganCreate()
    {
        return view('leader.bimbingan.create');
    }

    /**
     * Guidance Details
     */
    public function bimbinganDetail($id)
    {
        return view('leader.bimbingan.detail');
    }

    /**
     * Analysis & Reports
     */
    public function analisis()
    {
        $user = Auth::user();
        $projects = Project::where('leader_id', $user->id)->get();
        
        return view('leader.analisis.index', compact('projects'));
    }

    /**
     * Notes
     */
    public function catatan()
    {
        $user = Auth::user();
        $notes = Note::where('user_id', $user->id)->paginate(10);
        
        return view('leader.catatan.index', compact('notes'));
    }

    /**
     * Chat/Messages
     */
    public function obrolan()
    {
        return view('leader.obrolan.index');
    }

    /**
     * Profile
     */
    public function profil()
    {
        $user = Auth::user();
        
        return view('leader.profil.index', compact('user'));
    }

    /**
     * Help/Bantuan
     */
    public function bantuan()
    {
        return view('leader.bantuan.index');
    }
}
