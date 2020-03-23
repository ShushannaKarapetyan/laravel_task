<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenant;
use App\Tenant;

class TenantController extends Controller
{

    public function index()
    {
        return view('tenant.index', [
            'tenants' => Tenant::all()
        ]);
    }

    public function create(Tenant $tenant)
    {
        if (auth()->user()->can('create_update_delete', $tenant)) {
            return view('tenant.create');
        }

        return redirect(route('tenants.index'));
    }

    public function store(StoreTenant $request)
    {
        $tenantData = $request->only(['name', 'phone']);
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $tenantData['image'] = $fileNameToStore;
        }
        $tenant = auth()->user()->tenants()->create($tenantData);

        return redirect(route('tenants.index'))->with('success', 'Tenant saved successfully.');
    }

    public function show(Tenant $tenant)
    {
        return view('tenant.show-tenant', [
            'tenant' => $tenant
        ]);
    }

    public function edit(Tenant $tenant)
    {
        if (auth()->user()->can('create_update_delete', $tenant)) {
            return view('tenant.edit', [
                'tenant' => $tenant
            ]);
        }
        return redirect(route('tenants.index'));
    }

    public function update(StoreTenant $request, Tenant $tenant)
    {

        $tenantData = $request->only(['name', 'phone']);
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $tenantData['image'] = $fileNameToStore;
        }
        $tenant = $tenant->update($tenantData);

        return redirect(route('tenants.index'))->with('success', 'Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect(route('tenants.index'))->with('success', 'Tenant deleted successfully.');
    }

}
