<?php

namespace App\Services;

use App\Property;
use App\Tenant;
use Barryvdh\DomPDF\Facade as PDF;

class PdfDataLoader
{
    /**
     * @param $request
     * @return mixed
     */
    public static function loadPdf($request)
    {
        $skips = ['"', '[', ']'];

        $property = str_replace($skips, '', Property::where('id', $request->property_id)
            ->pluck('name_en'));

        $address = str_replace($skips, '', Property::where('id', $request->property_id)
            ->pluck('address'));

        $tenant = str_replace($skips, '', Tenant::where('id', $request->property_id)
            ->pluck('name'));

        $phone = str_replace($skips, '', Tenant::where('id', $request->property_id)
            ->pluck('phone'));

        return PDF::loadView('invoice', [
            'property' => $property,
            'tenant' => $tenant,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'monthly_rent' => $request->monthly_rent,
            'address' => $address,
            'phone' => $phone,
        ]);
    }
}
