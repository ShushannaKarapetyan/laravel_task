<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tenants()
    {
        return $this->belongsToMany(Tenant::class,'tenancies')->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function tenancies()
    {
        return $this->hasMany(Tenancy::class);
    }

}
