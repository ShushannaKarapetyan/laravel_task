<?php

namespace App\Http\Requests;

use App\Tenancy;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * @param TenancyRequest $request
     * @return bool
     * @throws ValidationException
     */
    public function fallsIntoExistingTimePeriods(TenancyRequest $request)
    {
        if (Tenancy::allowsTenancyDatePeriod($request)) {
            throw ValidationException::withMessages([
                'period' => ['Please change date.'],
            ]);
        }

        return Tenancy::allowsTenancyDatePeriod($request);
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
