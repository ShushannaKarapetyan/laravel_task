<?php

namespace App\Http\Controllers;

use App\Events\StoredTenProperties;
use App\Http\Requests\PropertyRequest;
use App\Notifications\LaravelTelegramNotification;
use App\Property;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $locale = Cookie::get('locale', 'en');
        $properties = Property::where('user_id', auth()->id())->paginate(5);

        return view('property.index', compact(['locale', 'properties']));
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
        $propertyData = $request->only([
                'name_en',
                'name_ru',
                'address',
                'description_en',
                'description_ru',
                'price',
            ]) + ['user_id' => $request->user()->id];

        Property::create($propertyData);

        if (Property::count() % 10 === 0) {

            StoredTenProperties::dispatch(config('mails.mails'));

            $request->user()->notify(new LaravelTelegramNotification());
        }

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

        $locale = Cookie::get('locale', 'en');

        return view('property.show', compact(['property', 'locale']));
    }

    /**
     * @param Property $property
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        return view('property.edit', compact('property'));
    }

    /**
     * @param PropertyRequest $request
     * @param Property $property
     * @return Redirector
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $propertyData = $request->only([
            'name_en',
            'name_ru',
            'address',
            'description_en',
            'description_ru',
            'price',
        ]);

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
