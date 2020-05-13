<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Services\TenantDataPreparer;
use App\Tenant;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class TenantController extends Controller
{
    /**
     * @return JsonResponse|View
     */
    public function index()
    {
        $tenants = Tenant::where('user_id', auth()->id())->paginate(3);

        if (request()->ajax()) {
            return Response::json([
                'tenants' => $tenants,
            ]);
        }

        return view('tenant.index');
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
    public function store(TenantRequest $request)
    {
        Tenant::where('user_id', auth()->id())
            ->create(TenantDataPreparer::prepareDataToSave($request));

        return ["message" => 'Tenant Created'];
    }

    /**
     * @param Tenant $tenant
     * @return JsonResponse|View
     * @throws AuthorizationException
     */
    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);

        if (request()->ajax()) {
            return Response::json([
                'tenant' => $tenant,
            ]);
        }

        return view('tenant.show');
    }

    /**
     * @param Tenant $tenant
     * @return JsonResponse|View
     * @throws AuthorizationException
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        if (request()->ajax()) {
            return Response::json(["tenant" => $tenant]);
        }

        return view('tenant.edit');
    }

    /**
     * @param TenantRequest $request
     * @param Tenant $tenant
     * @return array
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        $tenant->update(TenantDataPreparer::prepareDataToSave($request));

        return ["message" => 'Tenant Updated'];
    }

    /**
     * @param Tenant $tenant
     * @return array
     * @throws AuthorizationException
     */
    public function destroy(Tenant $tenant)
    {
        $this->authorize('delete', $tenant);

        $tenant->delete();

        return ["message" => 'Tenant Deleted'];
    }
}
