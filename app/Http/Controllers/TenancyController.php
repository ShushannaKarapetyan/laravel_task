<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenancyRequest;
use App\Property;
use App\Tenancy;
use App\Tenant;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TenancyController extends Controller
{
    /**
     * @return JsonResponse|View
     */
    public function index()
    {
        $locale = Cookie::get('locale', 'en');
        $tenancies = Tenancy::where('user_id', auth()->id())->with('tenant', 'property')->paginate(3);

        if (request()->ajax()) {
            return Response::json([
                'locale' => $locale,
                'tenancies' => $tenancies,
            ]);
        }

        return view('tenancy.index');
    }

    /**
     * @return JsonResponse|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Tenancy::class);

        $properties = Property::where('user_id', auth()->id())->pluck('name_en', 'id');
        $tenants = Tenant::where('user_id', auth()->id())->pluck('name', 'id');

        if (request()->ajax()) {
            return Response::json([
                'properties' => $properties,
                'tenants' => $tenants
            ]);
        }

        return view('tenancy.create');
    }

    /**
     * @param TenancyRequest $request
     * @return array
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

        return ["message" => 'Property Created'];
    }

    /**
     * @param Tenancy $tenancy
     * @return JsonResponse|View
     * @throws AuthorizationException
     */
    public function show(Tenancy $tenancy)
    {
        $this->authorize('view', $tenancy);

        $locale = Cookie::get('locale', 'en');

        $tenancy = Tenancy::where('id', $tenancy->id)->with('property', 'tenant')->get();

        if (request()->ajax()) {
            return Response::json([
                'locale' => $locale,
                'tenancy' => $tenancy,
            ]);
        }

        return view('tenancy.show');
    }

    /**
     * @param Tenancy $tenancy
     * @return JsonResponse|View
     * @throws AuthorizationException
     */
    public function edit(Tenancy $tenancy)
    {
        $this->authorize('update', $tenancy);

        $properties = Property::where('user_id', $tenancy->user_id)->pluck('name_en', 'id');
        $tenants = Tenant::where('user_id', $tenancy->user_id)->pluck('name', 'id');

        if (request()->ajax()) {
            return Response::json([
                'properties' => $properties,
                'tenants' => $tenants,
                'tenancy' => $tenancy
            ]);
        }

        return view('tenancy.edit');
    }

    /**
     * @param TenancyRequest $request
     * @param Tenancy $tenancy
     * @return array
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

        return ["message" => 'Property Updated'];
    }

    /**
     * @param Tenancy $tenancy
     * @return array
     * @throws AuthorizationException
     */
    public function destroy(Tenancy $tenancy)
    {
        $this->authorize('delete', $tenancy);

        $tenancy->delete();

        return ["message" => 'Property Updated'];
    }
}
