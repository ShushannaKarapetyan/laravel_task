<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $properties = Property::select(
            'name_en',
            'name_ru',
            'address',
            'description_en',
            'description_ru',
            'price')
            ->get()->toArray();

        $locale = Cookie::get('locale', 'en');

        return view('welcome', compact(['properties', 'locale']));
    }

    /**
     * @return JsonResponse|RedirectResponse
     */
    public function search()
    {
        $search = request('search');

        $properties = DB::table('properties')
            ->join('users', 'properties.user_id', '=', 'users.id')
            ->where('properties.name_en', 'like', "%$search%")
            ->orWhere('users.name', 'like', "%$search%")
            ->get('name_en');

        return Response::json(['data' => $properties]);
    }
}

