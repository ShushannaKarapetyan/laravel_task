<?php

namespace App\Policies;

use App\Tenancy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenancyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tenancy.
     *
     * @param User $user
     * @param Tenancy $tenancy
     * @return bool
     */
    public function view(User $user, Tenancy $tenancy): bool
    {
        return $tenancy->user_id === $user->id;
    }

    /**
     * Determine whether the user can create tenancies.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    /**
     * Determine whether the user can update the tenancy.
     *
     * @param User $user
     * @param Tenancy $tenancy
     * @return bool
     */
    public function update(User $user, Tenancy $tenancy): bool
    {
        return $tenancy->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the tenancy.
     *
     * @param User $user
     * @param Tenancy $tenancy
     * @return bool
     */
    public function delete(User $user, Tenancy $tenancy): bool
    {
        return $tenancy->user_id === $user->id;
    }
}
