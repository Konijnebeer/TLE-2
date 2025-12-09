<?php

namespace App\Policies;

use App\Models\NaturePark;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NatureParkPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NaturePark $naturePark): bool
    {
        // Check if the user is part of the connected group
        if ($user->group && $user->group->nature_park_id === $naturePark->id) {
            // Check if the group role is not a guest
            if ($user->group->role !== 'guest') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NaturePark $naturePark): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NaturePark $naturePark): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NaturePark $naturePark): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NaturePark $naturePark): bool
    {
        return false;
    }
}
