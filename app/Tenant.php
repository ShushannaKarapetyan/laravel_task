<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function properties(){
        return $this->hasMany(Property::class);
    }

    public function tenancies(){
        return $this->hasMany(Tenancy::class);
    }


}
