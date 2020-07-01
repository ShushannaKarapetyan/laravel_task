<?php

namespace App;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{
    protected array $fillable = ['ip'];

    /**
     * @param $firstDay
     * @param $lastDay
     * @return JsonResponse
     */
    public static function getPropertiesVisits($firstDay, $lastDay)
    {
        $dates = [];
        $visits = [];
        $uniqueVisits = [];

        $period = CarbonPeriod::create("{$firstDay}", "{$lastDay}");

        foreach ($period as $date) {
            array_push($dates,
                [
                    'start' => $date->startOfDay()->format('Y-m-d H:i:s'),
                    'end' => $date->endOfDay()->format('Y-m-d H:i:s'),
                ]);
        }

        foreach ($dates as $date) {
            $visits[] = DB::raw("count(CASE WHEN
                     created_at >= '{$date['start']}' AND created_at <= '{$date['end']}'
                     THEN id ELSE null END)");

            $uniqueVisits[] = DB::raw("count(DISTINCT CASE WHEN
                     created_at >= '{$date['start']}' AND created_at <= '{$date['end']}'
                     THEN ip ELSE null END)");
        }

        $visits = array_values(Visit::select($visits)->first()->toArray());

        $uniqueVisits = array_values(Visit::select($uniqueVisits)->first()->toArray());

        return response()->json([
            'period' => $period,
            'visits' => $visits,
            'uniqueVisits' => $uniqueVisits,
        ]);
    }
}
