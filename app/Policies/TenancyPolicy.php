<?php

namespace App\Policies;

use App\Tenancy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenancyPolicy
{
    use HandlesAuthorization;

    public function create_update_delete(User $user, Tenancy $tenancy)
    {
        if(auth()->user()->is_admin === 0){
            return true;
        }
        return false;
    }
}
