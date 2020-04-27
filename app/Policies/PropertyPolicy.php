<?php

namespace App\Policies;

use App\Property;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the property.
     *
     * @param User $user
     * @param Property $property
     * @return bool
     */
    public function view(User $user, Property $property): bool
    {
        return $property->user_id === $user->id;
    }

    /**
     * Determine whether the user can create properties.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    /**
     * Determine whether the user can update the property.
     *
     * @param User $user
     * @param Property $property
     * @return bool
     */
    public function update(User $user, Property $property): bool
    {
        return $property->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the property.
     *
     * @param User $user
     * @param Property $property
     * @return bool
     */
    public function delete(User $user, Property $property): bool
    {
        return $property->user_id === $user->id;
    }
}
