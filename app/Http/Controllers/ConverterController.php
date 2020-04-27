<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\View\View;

class ConverterController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $currencies = Rate::pluck('currency', 'id');
        $currenciesWithRates = Rate::pluck('rate', 'currency');

        return view('currency.converter', compact(['currencies', 'currenciesWithRates']));
    }
}
