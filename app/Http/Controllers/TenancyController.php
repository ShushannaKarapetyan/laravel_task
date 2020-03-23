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
            'tenancies' => Tenancy::all()
        ]);
    }

    public function create(Tenancy $tenancy)
    {
        if (auth()->user()->can('create_update_delete', $tenancy)) {
            return view('tenancy.create', [
                'properties' => auth()->user()->properties()->pluck('name', 'id'),
                'tenants' => auth()->user()->tenants()->pluck('name', 'id')
            ]);
        }

        return redirect(route('tenancies.index'));
    }

    public function store(StoreTenancy $request)
    {
        $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
        $tenancy = auth()->user()->tenancies()->create($tenancyData);
        //dd(Property::find($request->property_id)->tenants());
        //Property::find($request->property_id)->tenants()->attach(request('tenant_id'));

        return redirect(route('tenancies.index'))->with('success', 'Tenancy saved successfully.');
    }

    public function show(Tenancy $tenancy)
    {
        return view('tenancy.show-tenancy', [
            'tenancy' => $tenancy
        ]);
    }

    public function edit(Tenancy $tenancy)
    {
        if (auth()->user()->can('create_update_delete', $tenancy)) {
            return view('tenancy.edit', [
                'tenancy' => $tenancy,
                'properties' => auth()->user()->properties()->pluck('name', 'id'),
                'tenants' => auth()->user()->tenants()->pluck('name', 'id')
            ]);
        }

        return redirect(route('tenancies.index'));
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
