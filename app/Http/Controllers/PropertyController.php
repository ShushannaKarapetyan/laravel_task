<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProperty;
use App\Property;

class PropertyController extends Controller
{

    public function index()
    {
        return  view('property.index',[
            'properties'=>Property::paginate(5)
        ]);
    }

    public function create(Property $property)
    {
        if (auth()->user()->can('create_update_delete', $property)) {
            return view('property.create');
        }
        //return abort(403);
        return redirect(route('properties.index'));
    }

    public function store(StoreProperty $request)
    {
        $property = new Property(request(['name','address','description','price']));
        $property->user_id = auth()->user()->id;
        $property->save();
        return redirect(route('properties.index'))->with('success','Property saved successfully.');
    }

    public function show(Property $property)
    {
        return view('property.show-property',[
            'property'=>$property
        ]);
    }

    public function edit(Property $property)
    {
        if (auth()->user()->can('create_update_delete', $property)) {
            return view('property.edit',[
                'property'=>$property
            ]);
        }
        return redirect(route('properties.index'));
    }

    public function update(StoreProperty $request, Property $property)
    {
        $property->update([
            'name'=>request('name'),
            'address'=>request('address'),
            'description'=>request('description'),
            'price'=>request('price'),
            'user_id'=>auth()->user()->id
        ]);

        return redirect(route('properties.index'))->with('success','Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect(route('properties.index'))->with('success','Property deleted successfully');
    }
}
