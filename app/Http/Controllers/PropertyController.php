<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Property;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PropertyController extends Controller
{

    /**
     * @return View
     */
    public function index()
    {
        return view('property.index', [
            'properties' => auth()->user()->properties()->paginate(5)
        ]);
    }

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Property::class);

        return view('property.create');
    }

    /**
     * @param PropertyRequest $request
     * @return Redirector
     */
    public function store(PropertyRequest $request)
    {
        $propertyData = $request->only(['name', 'address', 'description', 'price']);
        auth()->user()->properties()->create($propertyData);

        return redirect(route('properties.index'))
            ->with('success', 'Property saved successfully.');
    }

    /**
     * @param Property $property
     * @return View
     * @throws AuthorizationException
     */
    public function show(Property $property)
    {
        $this->authorize('view', $property);

        return view('property.show', [
            'property' => $property
        ]);
    }

    /**
     * @param Property $property
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        return view('property.edit', [
            'property' => $property
        ]);
    }

    /**
     * @param PropertyRequest $request
     * @param Property $property
     * @return Redirector
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $propertyData = $request->only(['name', 'address', 'description', 'price']);
        $property->update($propertyData);

        return redirect(route('properties.index'))
            ->with('success', 'Property updated successfully.');
    }

    /**
     * @param Property $property
     * @return Redirector
     * @throws AuthorizationException
     */
    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        $property->delete();

        return redirect(route('properties.index'))
            ->with('success', 'Property deleted successfully');
    }
}
