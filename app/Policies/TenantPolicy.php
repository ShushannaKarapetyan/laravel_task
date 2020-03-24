<?php

namespace App\Policies;

use App\Tenant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tenants.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the tenant.
     *
     * @param User $user
     * @param Tenant $tenant
     * @return mixed
     */
    public function view(User $user, Tenant $tenant)
    {
        return $tenant->user->is($user);
    }

    /**
     * Determine whether the user can create tenants.
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
     * Determine whether the user can update the tenant.
     *
     * @param User $user
     * @param Tenant $tenant
     * @return mixed
     */
    public function update(User $user, Tenant $tenant)
    {
        return $tenant->user->is($user);
    }

    /**
     * Determine whether the user can delete the tenant.
     *
     * @param User $user
     * @param Tenant $tenant
     * @return mixed
     */
    public function delete(User $user, Tenant $tenant)
    {
        //
    }

}
