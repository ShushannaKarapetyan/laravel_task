<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenancy;
use App\Property;
use App\Tenancy;
use App\Tenant;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class TenancyController extends Controller
{
    public function index()
    {
        return view('tenancy.index', [
            'tenancies' => auth()->user()->tenancies()->paginate(5)
        ]);
    }

    public function create()
    {
        $this->authorize('create', Tenancy::class);

        return view('tenancy.create', [
            'properties' => auth()->user()->properties()->pluck('name', 'id'),
            'tenants' => auth()->user()->tenants()->pluck('name', 'id')
        ]);
    }

    public function store(StoreTenancy $request)
    {
        if (!$request->fallsIntoExistingTimePeriods($request)) {
            $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
            $tenancy = auth()->user()->tenancies()->create($tenancyData);
            $message = 'Tenancy saved successfully.';

            return redirect(route('tenancies.index'))->with('success', $message);
        }

        throw ValidationException::withMessages([
            'period' => ['Please change date.'],
        ]);

    }

    public function show(Tenancy $tenancy)
    {
        $this->authorize('view', $tenancy);

        return view('tenancy.show', [
            'tenancy' => $tenancy
        ]);
    }

    public function edit(Tenancy $tenancy)
    {
        $this->authorize('update', $tenancy);

        return view('tenancy.edit', [
            'tenancy' => $tenancy,
            'properties' => auth()->user()->properties()->pluck('name', 'id'),
            'tenants' => auth()->user()->tenants()->pluck('name', 'id')
        ]);
    }

    public function update(StoreTenancy $request, Tenancy $tenancy)
    {
        $route = redirect(route('tenancies.index'))
            ->with('success', 'Tenancy updated successfully.');

        if (!$request->fallsIntoExistingTimePeriods($request)) {
            $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
            $tenancy->update($tenancyData);

            return $route;
        } else {
            if ($request->property_id == $tenancy->property_id) {
                return $route;
            }
        }

        throw ValidationException::withMessages([
            'period' => ['Please change date.'],
        ]);

    }

    public function destroy(Tenancy $tenancy)
    {
        $this->authorize('delete', $tenancy);
        $tenancy->delete();

        return redirect(route('tenancies.index'))->with('success', 'Tenancy deleted successfully');
    }
}
