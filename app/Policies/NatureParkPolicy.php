<?php

namespace App\Policies;

use App\Enums\GroupRole;
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
        // Check if the user is part of the group that owns this nature park
        // and that their role in the group is not 'guest'
        return $user->groups()
            ->where('groups.id', $naturePark->group_id)
            ->wherePivot('role', '!=', GroupRole::GUEST)
            ->exists();
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
