<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenancy;
use App\Property;
use App\Tenancy;
use App\Tenant;

class TenancyController extends Controller
{
    public function index()
    {
        return view('tenancy.index', [
            'tenancies' => auth()->user()->tenancies()->paginate(3)
        ]);
    }

    public function create(Tenancy $tenancy)
    {
        $this->authorize('create', $tenancy);

        return view('tenancy.create', [
            'properties' => auth()->user()->properties()->pluck('name', 'id'),
            'tenants' => auth()->user()->tenants()->pluck('name', 'id')
        ]);
    }

    public function store(StoreTenancy $request)
    {
        $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
        $tenancy = auth()->user()->tenancies()->create($tenancyData);
        Property::find($request->property_id)->tenants()->attach($request->only(['tenant_id']));
        //or
        //Tenant::find($request->tenant_id)->properties()->attach($request->only(['property_id']));

        return redirect(route('tenancies.index'))->with('success', 'Tenancy saved successfully.');
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
        $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
        $tenancy = $tenancy->update($tenancyData);

        return redirect(route('tenancies.index'))->with('success', 'Tenancy updated successfully.');
    }

    public function destroy(Tenancy $tenancy)
    {
        $tenancy->delete();

        return redirect(route('tenancies.index'))->with('success', 'Tenancy deleted successfully');
    }
}
