<?php

namespace App\Http\Controllers\Mastercard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Note;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class MastercardController extends Controller
{
    /**
     * Mastercard Dashboard
     */
    public function beranda()
    {
        $user = Auth::user();
        $users = User::where('role', 'user')->count();
        $notes = Note::count();
        $activities = ActivityLog::count();

        return view('mastercard.beranda.index', compact('users', 'notes', 'activities'));
    }

    /**
     * User Management
     */
    public function manajemenPengguna()
    {
        $users = User::where('role', 'user')->paginate(10);

        return view('mastercard.manajemen.pengguna', compact('users'));
    }

    /**
     * Account Management
     */
    public function manajemenAkun()
    {
        $user = Auth::user();

        return view('mastercard.manajemen.akun', compact('user'));
    }

    /**
     * Notes
     */
    public function catatan()
    {
        $notes = Note::paginate(10);

        return view('mastercard.catatan.index', compact('notes'));
    }

    /**
     * Activity Log
     */
    public function catatanAktivitas()
    {
        $activities = ActivityLog::paginate(10);

        return view('mastercard.catatan_aktivitas', compact('activities'));
    }

    /**
     * Chat/Messages
     */
    public function obrolan()
    {
        return view('mastercard.obrolan.index');
    }

    /**
     * Tools/Alat
     */
    public function alat()
    {
        return view('mastercard.alat.index');
    }

    /**
     * Profile
     */
    public function profil()
    {
        $user = Auth::user();

        return view('mastercard.profil.index', compact('user'));
    }

    /**
     * Help/Bantuan
     */
    public function bantuan()
    {
        return view('mastercard.bantuan.index');
    }
}
