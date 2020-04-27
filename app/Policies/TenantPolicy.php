<?php

namespace App\Policies;

use App\Tenant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tenant.
     *
     * @param User $user
     * @param Tenant $tenant
     * @return bool
     */
    public function view(User $user, Tenant $tenant): bool
    {
        return $tenant->user_id === $user->id;
    }

    /**
     * Determine whether the user can create tenants.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    /**
     * Determine whether the user can update the tenant.
     *
     * @param User $user
     * @param Tenant $tenant
     * @return bool
     */
    public function update(User $user, Tenant $tenant): bool
    {
        return $tenant->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the tenant.
     *
     * @param User $user
     * @param Tenant $tenant
     * @return bool
     */
    public function delete(User $user, Tenant $tenant): bool
    {
        return $tenant->user_id === $user->id;
    }
}
