<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenant;
use App\Tenant;

class TenantController extends Controller
{

    public function index()
    {
        return view('tenant.index', [
            'tenants' => auth()->user()->tenants()->paginate(5)
        ]);
    }

    public function create(Tenant $tenant)
    {
        $this->authorize('create', $tenant);

        return view('tenant.create');
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
        $this->authorize('view', $tenant);

        return view('tenant.show', [
            'tenant' => $tenant
        ]);
    }

    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        return view('tenant.edit', [
            'tenant' => $tenant
        ]);
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
