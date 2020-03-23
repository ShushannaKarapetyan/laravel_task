<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenant;
use App\Tenant;

class TenantController extends Controller
{

    public function index()
    {
        return  view('tenant.index',[
            'tenants'=>Tenant::all()
        ]);
    }

    public function create(Tenant $tenant)
    {
        if (auth()->user()->can('create_update_delete', $tenant)) {
            return view('tenant.create');
        }
        return redirect(route('tenants.index'));
    }

    public function store(StoreTenant $request){
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            Tenant::create([
                'name'=>request('name'),
                'phone'=>request('phone'),
                'image'=>$fileNameToStore,
                'user_id'=>auth()->user()->id
            ]);
        }
        return redirect(route('tenants.index'))->with('success','Tenant saved successfully.');
    }

    public function show(Tenant $tenant)
    {
        return view('tenant.show-tenant',[
            'tenant'=>$tenant
        ]);
    }

    public function edit(Tenant $tenant)
    {
        if (auth()->user()->can('create_update_delete', $tenant)) {
            return view('tenant.edit',[
                'tenant'=>$tenant
            ]);
        }
        return redirect(route('tenants.index'));
    }

    public function update(StoreTenant $request, Tenant $tenant)
    {
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $tenant->update([
                'name'=>request('name'),
                'phone'=>request('phone'),
                'image'=>$fileNameToStore,
                'user_id'=>auth()->user()->id
            ]);
        }
        return redirect(route('tenants.index'))->with('success','Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect(route('tenants.index'))->with('success','Tenant deleted successfully');
    }

}
