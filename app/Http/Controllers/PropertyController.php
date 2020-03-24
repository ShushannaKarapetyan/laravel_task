<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProperty;
use App\Property;

class PropertyController extends Controller
{

    public function index()
    {
        return view('property.index', [
            'properties' => auth()->user()->properties()->paginate(5)
        ]);
    }

    public function create(Property $property)
    {
        $this->authorize('create', $property);

        return view('property.create');
    }

    public function store(StoreProperty $request)
    {
        $propertyData = $request->only(['name', 'address', 'description', 'price']);
        $property = auth()->user()->properties()->create($propertyData);

        return redirect(route('properties.index'))->with('success', 'Property saved successfully.');
    }

    public function show(Property $property)
    {
        $this->authorize('view', $property);

        return view('property.show', [
            'property' => $property
        ]);
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        return view('property.edit', [
            'property' => $property
        ]);
    }

    public function update(StoreProperty $request, Property $property)
    {
        $propertyData = $request->only(['name', 'address', 'description', 'price']);
        $property = $property->update($propertyData);

        return redirect(route('properties.index'))->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect(route('properties.index'))->with('success', 'Property deleted successfully');
    }
}
