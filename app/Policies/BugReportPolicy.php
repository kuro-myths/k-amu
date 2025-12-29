<?php

namespace App\Policies;

use App\Models\BugReport;
use App\Models\User;

class BugReportPolicy
{
    public function view(User $user, BugReport $bug): bool
    {
        return $user->id === $bug->reporter_id || $user->isSuperAdmin() || $user->isTester();
    }

    public function create(User $user): bool
    {
        return $user->isTester() || $user->isSuperAdmin();
    }

    public function update(User $user, BugReport $bug): bool
    {
        return $user->id === $bug->reporter_id || $user->isSuperAdmin() || ($user->isTester());
    }

    public function delete(User $user, BugReport $bug): bool
    {
        return $user->id === $bug->reporter_id || $user->isSuperAdmin();
    }

    public function restore(User $user, BugReport $bug): bool
    {
        return $user->id === $bug->reporter_id || $user->isSuperAdmin();
    }

    public function forceDelete(User $user, BugReport $bug): bool
    {
        return $user->isSuperAdmin();
    }
}
