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
     * @return mixed
     */
    public function view(User $user, Property $property)
    {
        return $property->user->is($user);
    }

    /**
     * Determine whether the user can create properties.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (!$user->is_admin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the property.
     *
     * @param User $user
     * @param Property $property
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return $property->user->is($user);
    }

    /**
     * Determine whether the user can delete the property.
     *
     * @param User $user
     * @param Property $property
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
        //return $property->user->is($user);
    }

}
