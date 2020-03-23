<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    public function tenancies(){
        return $this->hasMany(Tenancy::class);
    }

}
