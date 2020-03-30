<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenancyRequest;
use App\Tenancy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TenancyController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('tenancy.index', [
            'tenancies' => auth()->user()->tenancies()->paginate(5)
        ]);
    }

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Tenancy::class);

        return view('tenancy.create', [
            'properties' => auth()->user()->properties()->pluck('name', 'id'),
            'tenants' => auth()->user()->tenants()->pluck('name', 'id')
        ]);
    }

    /**
     * @param TenancyRequest $request
     * @return Redirector
     * @throws ValidationException
     */
    public function store(TenancyRequest $request)
    {
        if (!$request->fallsIntoExistingTimePeriods($request)) {
            $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
            auth()->user()->tenancies()->create($tenancyData);

            return redirect(route('tenancies.index'))
                ->with('success', 'Tenancy saved successfully.');
        }

        throw ValidationException::withMessages([
            'period' => ['Please change date.'],
        ]);

    }

    /**
     * @param Tenancy $tenancy
     * @return View
     * @throws AuthorizationException
     */
    public function show(Tenancy $tenancy)
    {
        $this->authorize('view', $tenancy);

        return view('tenancy.show', [
            'tenancy' => $tenancy
        ]);
    }

    /**
     * @param Tenancy $tenancy
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Tenancy $tenancy)
    {
        $this->authorize('update', $tenancy);

        return view('tenancy.edit', [
            'tenancy' => $tenancy,
            'properties' => auth()->user()->properties()->pluck('name', 'id'),
            'tenants' => auth()->user()->tenants()->pluck('name', 'id')
        ]);
    }

    /**
     * @param TenancyRequest $request
     * @param Tenancy $tenancy
     * @return Redirector
     * @throws ValidationException
     */
    public function update(TenancyRequest $request, Tenancy $tenancy)
    {
        if (!$request->fallsIntoExistingTimePeriods($request)) {
            $tenancyData = $request->only(['property_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent']);
            $tenancy->update($tenancyData);

            return redirect(route('tenancies.index'))
                ->with('success', 'Tenancy updated successfully.');
        }

        throw ValidationException::withMessages([
            'period' => ['Please change date.'],
        ]);

    }

    /**
     * @param Tenancy $tenancy
     * @return Redirector
     * @throws AuthorizationException
     */
    public function destroy(Tenancy $tenancy)
    {
        $this->authorize('delete', $tenancy);

        $tenancy->delete();

        return redirect(route('tenancies.index'))
            ->with('success', 'Tenancy deleted successfully.');
    }
}
