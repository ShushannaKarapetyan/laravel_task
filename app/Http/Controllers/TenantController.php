<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Services\TenantDataPreparer;
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
        $tenants = Tenant::where('user_id', auth()->id())->paginate(5);

        return view('tenant.index', compact('tenants'));
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
     * @return Redirector
     */
    public function store(TenantRequest $request)
    {
        Tenant::where('user_id', auth()->id())
            ->create(TenantDataPreparer::prepareDataToSave($request));

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

        return view('tenant.show', compact('tenant'));
    }

    /**
     * @param Tenant $tenant
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        return view('tenant.edit', compact('tenant'));
    }

    /**
     * @param TenantRequest $request
     * @param Tenant $tenant
     * @return Redirector
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        $tenant->update(TenantDataPreparer::prepareDataToSave($request));

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
