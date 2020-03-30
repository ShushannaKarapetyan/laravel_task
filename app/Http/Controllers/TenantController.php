<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Tenant;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TenantController extends Controller
{

    /**
     * @return View
     */
    public function index()
    {
        return view('tenant.index', [
            'tenants' => auth()->user()->tenants()->paginate(5)
        ]);
    }

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Tenant::class);

        return view('tenant.create');
    }

    /**
     * @param TenantRequest $request
     * @return array
     */
    public function uploadTenantImage(TenantRequest $request)
    {
        $tenantData = $request->only(['name', 'phone']);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = time() . '.' . $extension;
            $request->file('image')->storeAs('public/images', $fileNameToStore);
            $tenantData['image'] = $fileNameToStore;
        }

        return $tenantData;
    }

    /**
     * @param TenantRequest $request
     * @return Redirector
     */
    public function store(TenantRequest $request)
    {
        auth()->user()->tenants()->create($this->uploadTenantImage($request));

        return redirect(route('tenants.index'))
            ->with('success', 'Tenant saved successfully.');
    }

    /**
     * @param Tenant $tenant
     * @return View
     * @throws AuthorizationException
     */
    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);

        return view('tenant.show', [
            'tenant' => $tenant
        ]);
    }

    /**
     * @param Tenant $tenant
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        return view('tenant.edit', [
            'tenant' => $tenant
        ]);
    }

    /**
     * @param TenantRequest $request
     * @param Tenant $tenant
     * @return Redirector
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        $tenant->update($this->uploadTenantImage($request));

        return redirect(route('tenants.index'))
            ->with('success', 'Tenant updated successfully.');
    }

    /**
     * @param Tenant $tenant
     * @return Redirector
     * @throws AuthorizationException
     */
    public function destroy(Tenant $tenant)
    {
        $this->authorize('delete', $tenant);

        $tenant->delete();

        return redirect(route('tenants.index'))
            ->with('success', 'Tenant deleted successfully.');
    }

}
