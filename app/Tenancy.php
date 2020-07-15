<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tenancy extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'tenant_id',
        'start_date',
        'end_date',
        'monthly_rent',
        'invoice',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @param $request
     * @return bool
     */
    public static function allowsTenancyDatePeriod($request): bool
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $allowsTenancyDatePeriod = Tenancy::where('property_id', $request->property_id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<=', $startDate)
                    ->where('end_date', '>=', $endDate)
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '>=', $startDate)
                            ->where('end_date', '<=', $endDate);
                    })->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('end_date', '>=', $startDate)
                            ->where('end_date', '<=', $endDate);
                    })->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '>=', $startDate)
                            ->where('start_date', '<=', $endDate);
                    });
            });

        if ($request->route()->hasParameter('tenancy')) {
            return $allowsTenancyDatePeriod->where('id', '!=', $request->tenancy->id)->exists();
        }

        return $allowsTenancyDatePeriod->exists();
    }
}
