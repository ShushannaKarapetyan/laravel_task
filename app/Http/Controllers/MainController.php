<?php

namespace App\Http\Controllers;

use App\Property;

class MainController extends Controller
{
    public function index()
    {
        $properties = Property::select('name', 'address', 'description', 'price')->get()->toArray();

        return view('welcome', [
            'properties' => $properties
        ]);
    }


}
