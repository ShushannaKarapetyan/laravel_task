<?php

namespace App\Policies;

use App\Property;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;


    public function create_update_delete(User $user, Property $property){
        if(auth()->user()->is_admin === 0){
            return true;
        }
        return false;
    }


}
