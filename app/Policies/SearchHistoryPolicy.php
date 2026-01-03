<?php

namespace App\Policies;

use App\Models\SearchHistory;
use App\Models\User;

class SearchHistoryPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SearchHistory $searchHistory): bool
    {
        return $user->id === $searchHistory->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SearchHistory $searchHistory): bool
    {
        return $user->id === $searchHistory->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SearchHistory $searchHistory): bool
    {
        return $user->id === $searchHistory->user_id;
    }
}
