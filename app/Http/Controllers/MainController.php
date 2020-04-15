<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    public function index()
    {
        $properties = Property::select('name_en', 'name_ru', 'address', 'description_en', 'description_ru', 'price')->get()->toArray();


        return view('welcome', [
            'properties' => $properties,
            'locale' => Cookie::get('locale')
        ]);
    }


}
