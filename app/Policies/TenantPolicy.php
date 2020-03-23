<?php

namespace App\Policies;

use App\Tenant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    public function create_update_delete(User $user, Tenant $tenant)
    {
        if(auth()->user()->is_admin === 0){
            return true;
        }
        return false;
    }

}
