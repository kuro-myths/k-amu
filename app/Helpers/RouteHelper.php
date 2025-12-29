<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RouteHelper
{
    /**
     * Get the profile route for the current user's role
     */
    public static function getProfileRoute()
    {
        if (!Auth::check()) {
            return '#';
        }

        $user = Auth::user();
        $role = $user->role ?? 'user';

        return route("{$role}.profil");
    }
}
