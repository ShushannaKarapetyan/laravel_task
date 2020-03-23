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
        return  view('tenancy.index',[
            'tenancies'=>Tenancy::all()
        ]);
    }

    public function create(Tenancy $tenancy)
    {
        if (auth()->user()->can('create_update_delete', $tenancy)) {
            return view('tenancy.create',[
                'properties'=>Property::all(),
                'tenants'=>Tenant::all()
            ]);
        }
        return redirect(route('tenancies.index'));

    }

    public function store(StoreTenancy $request)
    {
        $tenancy = new Tenancy(request(['property_id','tenant_id','start_date','end_date','monthly_rent']));
        $tenancy->user_id = auth()->user()->id;
        $tenancy->save();
        $property = Property::find(request('property_id'));
        $property->tenant_id = request('tenant_id');
        $property->save();

        return redirect(route('tenancies.index'))->with('success','Tenancy saved successfully.');
    }

    public function show(Tenancy $tenancy)
    {
        return view('tenancy.show-tenancy',[
            'tenancy'=>$tenancy
        ]);
    }

    public function edit(Tenancy $tenancy)
    {
        if (auth()->user()->can('create_update_delete', $tenancy)) {
            return view('tenancy.edit',[
                'tenancy'=>$tenancy,
                'properties'=>Property::all(),
                'tenants'=>Tenant::all()
            ]);
        }
        return redirect(route('tenancies.index'));
    }

    public function update(StoreTenancy $request, Tenancy $tenancy)
    {
        $tenancy->update([
            'property_id'=>request('property_id'),
            'tenant_id'=>request('tenant_id'),
            'start_date'=>request('start_date'),
            'end_date'=>request('end_date'),
            'monthly_rent'=>request('monthly_rent'),
            'user_id'=>auth()->user()->id
        ]);
        $property = Property::find(request('property_id'));
        $property->tenant_id = request('tenant_id');
        $property->save();
        return redirect(route('tenancies.index'))->with('success','Tenancy updated successfully.');
    }

    public function destroy(Tenancy $tenancy)
    {
        $tenancy->delete();
        return redirect(route('tenancies.index'))->with('success','Tenancy deleted successfully');
    }
}
