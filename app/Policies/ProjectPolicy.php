<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->leader_id;
    }

    public function create(User $user): bool
    {
        return $user->isLeader() || $user->isSuperAdmin();
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->leader_id || $user->isSuperAdmin();
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->leader_id || $user->isSuperAdmin();
    }

    public function restore(User $user, Project $project): bool
    {
        return $user->id === $project->leader_id || $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return $user->isSuperAdmin();
    }
}
