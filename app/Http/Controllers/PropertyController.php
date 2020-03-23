<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProperty;
use App\Property;

class PropertyController extends Controller
{

    public function index()
    {
        return view('property.index', [
            'properties' => Property::paginate(5)
        ]);
    }

    public function create(Property $property)
    {
        if (auth()->user()->can('create_update_delete', $property)) {
            return view('property.create');
        }

        return redirect(route('properties.index'));
    }

    public function store(StoreProperty $request)
    {
        $propertyData = $request->only(['name', 'address', 'description', 'price']);
        $property = auth()->user()->properties()->create($propertyData);

        return redirect(route('properties.index'))->with('success', 'Property saved successfully.');
    }

    public function show(Property $property)
    {
        return view('property.show-property', [
            'property' => $property
        ]);
    }

    public function edit(Property $property)
    {
        if (auth()->user()->can('create_update_delete', $property)) {
            return view('property.edit', [
                'property' => $property
            ]);
        }

        return redirect(route('properties.index'));
    }

    public function update(StoreProperty $request, Property $property)
    {
        $propertyData = $request->only(['name', 'address', 'description', 'price']);
        $property = auth()->user()->properties()->update($propertyData);

        return redirect(route('properties.index'))->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect(route('properties.index'))->with('success', 'Property deleted successfully');
    }
}
