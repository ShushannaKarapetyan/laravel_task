<?php

namespace App\Http\Requests;

use App\Tenancy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class TenancyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function fallsIntoExistingTimePeriods(TenancyRequest $request)
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

        if ($this->route()->hasParameter('tenancy')) {
            return $allowsTenancyDatePeriod->where('id', '!=', $this->tenancy->id)->exists();
        }

        return $allowsTenancyDatePeriod->exists();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
            'monthly_rent' => 'required|numeric',
        ];
    }
}