<?php

namespace App\Policies;

use App\Tenancy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenancyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tenancies.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the tenancy.
     *
     * @param User $user
     * @param Tenancy $tenancy
     * @return mixed
     */
    public function view(User $user, Tenancy $tenancy)
    {
        return $tenancy->user->is($user);
    }

    /**
     * Determine whether the user can create tenancies.
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
     * Determine whether the user can update the tenancy.
     *
     * @param User $user
     * @param Tenancy $tenancy
     * @return mixed
     */
    public function update(User $user, Tenancy $tenancy)
    {
        return $tenancy->user->is($user);
    }

    /**
     * Determine whether the user can delete the tenancy.
     *
     * @param User $user
     * @param Tenancy $tenancy
     * @return mixed
     */
    public function delete(User $user, Tenancy $tenancy)
    {
        //
    }

}
