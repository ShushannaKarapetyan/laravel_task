<?php

namespace App\Http\Controllers;

use App\Events\StoredTenProperties;
use App\Http\Requests\PropertyRequest;
use App\Notifications\LaravelTelegramNotification;
use App\Property;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * @return JsonResponse|View
     */
    public function index()
    {
        $locale = Cookie::get('locale', 'en');
        $properties = Property::where('user_id', auth()->id())->paginate(5);

        if (request()->ajax()) {
            return Response::json([
                'locale' => $locale,
                'properties' => $properties,
            ]);
        }

        return view('property.index');
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
     * @return array
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

        return ["message" => 'Property Created'];
    }

    /**
     * @param Property $property
     * @return JsonResponse|View
     * @throws AuthorizationException
     */
    public function show(Property $property)
    {
        $this->authorize('view', $property);

        $locale = Cookie::get('locale', 'en');

        if (request()->ajax()) {
            return Response::json([
                'locale' => $locale,
                'property' => $property,
            ]);
        }

        return view('property.show');
    }

    /**
     * @param Property $property
     * @return Factory|JsonResponse|View
     * @throws AuthorizationException
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        if (request()->ajax()) {
            return Response::json(["property" => $property]);
        }

        return view('property.edit');
    }

    /**
     * @param PropertyRequest $request
     * @param Property $property
     * @return array
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

        return ["message" => 'Property Updated'];
    }

    /**
     * @param Property $property
     * @return array
     * @throws AuthorizationException
     */
    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        $property->delete();

        return ["message" => 'Property Deleted'];
    }
}
