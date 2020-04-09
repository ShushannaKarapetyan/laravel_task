<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConverterController extends Controller
{
    public function index(Request $request)
    {
        $currencies = Rate::pluck('currency', 'id');

        /*if ($request->ajax()) {
            $rate = Rate::where('id', $request->currency)->pluck('rate')->first();
            $convert = $request->amount * $rate;
            return response()->json(['data' => $convert]);
        }*/

       /* $currenciesWithRates = DB::table('rates')->select('currency', 'rate')->get();
        $keysValues = array();

        foreach ($currenciesWithRates as $key => $value) {
            $keysValues[$value->currency] = $value->rate;
        }*/

        $currenciesWithRates = Rate::pluck('rate','currency');

        return view('currency.converter', [
            'currencies' => $currencies,
            'currenciesWithRates' => $currenciesWithRates
        ]);
    }

}
