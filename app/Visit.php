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
     * @param $start
     * @param $end
     * @return JsonResponse
     */
    public static function getPropertiesVisits($firstDay, $lastDay, $start, $end)
    {
        $dates = [];
        $visits = [];
        $uniqueVisits = [];

        $period = CarbonPeriod::create("{$firstDay}", "{$lastDay}");

        foreach ($period as $date) {
            array_push($dates,
                [
                    'start' => $date->$start()->format('Y-m-d H:i:s'),
                    'end' => $date->$end()->format('Y-m-d H:i:s'),
                ]);
        }

        $dates = array_unique($dates, SORT_REGULAR);

        /*
         * if $firstDay of the period isn't the start of the week (f.e. wednesday),
         * take $firstDay instead the first day of the week (monday), the same for monthly.
         */
        if ($start === 'startOfWeek' || $start === 'startOfMonth') {
            $dates[0]['start'] = $firstDay->startOfDay()->format('Y-m-d H:i:s');
        }

        /*
         * if $lastDay of the period isn't the end of the week (f.e. wednesday),
         * take $lastDay instead the last day of the week (sunday), the same for monthly.
         */
        if ($end === 'endOfWeek' || $end === 'endOfMonth') {
            $endOfDates = end($dates);
            $endOfDates['end'] = $lastDay->endOfDay()->format('Y-m-d H:i:s');
            array_pop($dates);
            array_push($dates, $endOfDates);
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
            'dates' => $dates,
        ]);
    }
}
