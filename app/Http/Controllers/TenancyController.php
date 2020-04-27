<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenancyRequest;
use App\Property;
use App\Tenancy;
use App\Tenant;
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
        $tenancies = Tenancy::where('user_id', auth()->id())->paginate(5);

        return view('tenancy.index', compact('tenancies'));
    }

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Tenancy::class);

        $properties = Property::where('user_id', auth()->id())->pluck('name_en', 'id');
        $tenants = Tenant::where('user_id', auth()->id())->pluck('name', 'id');

        return view('tenancy.create', compact(['properties', 'tenants']));
    }

    /**
     * @param TenancyRequest $request
     * @return Redirector
     * @throws ValidationException
     */
    public function store(TenancyRequest $request)
    {
        $request->fallsIntoExistingTimePeriods($request);

        $tenancyData = $request->only([
                'property_id',
                'tenant_id',
                'start_date',
                'end_date',
                'monthly_rent',
            ]) + ['user_id' => $request->user()->id];

        Tenancy::create($tenancyData);

        return redirect(route('tenancies.index'))
            ->with('success', 'Tenancy saved successfully.');
    }

    /**
     * @param Tenancy $tenancy
     * @return View
     * @throws AuthorizationException
     */
    public function show(Tenancy $tenancy)
    {
        $this->authorize('view', $tenancy);

        return view('tenancy.show', compact('tenancy'));
    }

    /**
     * @param Tenancy $tenancy
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Tenancy $tenancy)
    {
        $this->authorize('update', $tenancy);

        $properties = Property::where('user_id', $tenancy->user_id)->pluck('name_en', 'id');
        $tenants = Tenant::where('user_id', $tenancy->user_id)->pluck('name', 'id');

        return view('tenancy.edit', compact(['tenancy', 'properties', 'tenants']));
    }

    /**
     * @param TenancyRequest $request
     * @param Tenancy $tenancy
     * @return Redirector
     * @throws ValidationException
     */
    public function update(TenancyRequest $request, Tenancy $tenancy)
    {
        $request->fallsIntoExistingTimePeriods($request);

        $tenancyData = $request->only([
            'property_id',
            'tenant_id',
            'start_date',
            'end_date',
            'monthly_rent',
        ]);

        $tenancy->update($tenancyData);

        return redirect(route('tenancies.index'))
            ->with('success', 'Tenancy updated successfully.');
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
