<?php

namespace App\Http\Controllers;

use App\Visit;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PropertiesVisitsController extends Controller
{
    /**
     * @return Factory|JsonResponse|View
     */
    public function index()
    {
        if (request()->ajax()) {
            $dates = [];
            $selectCount = [];
            $selectUniqueCount = [];
            $firstDay = Carbon::now()->firstOfMonth();
            $lastDay = Carbon::now()->lastOfMonth();

            $period = CarbonPeriod::create("{$firstDay}", "{$lastDay}");

            foreach ($period as $date) {
                array_push($dates,
                    [
                        'start' => $date->format('Y-m-d H:i:s'),
                        'end' => $date->copy()->endOfDay()->format('Y-m-d H:i:s'),
                    ]);
            }

            foreach ($dates as $date) {
                $selectCount[] = DB::raw("count(CASE WHEN
                    created_at >= '{$date['start']}' AND created_at <= '{$date['end']}'
                    THEN id ELSE null END)");

                $selectUniqueCount[] = DB::raw("count(DISTINCT CASE WHEN
                    created_at >= '{$date['start']}' AND created_at <= '{$date['end']}'
                    THEN ip ELSE null END)");
            }

            $visits = array_values(Visit::select($selectCount)->first()->toArray());

            $uniqueVisits = array_values(Visit::select($selectUniqueCount)->first()->toArray());

            return response()->json([
                'visits' => $visits,
                'uniqueVisits' => $uniqueVisits,
            ]);
        }

        return view('property.visits');
    }
}
