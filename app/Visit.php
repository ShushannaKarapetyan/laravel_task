<?php

namespace App;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{
    protected $fillable = [
        'ip',
    ];

    /**
     * @param $firstDay
     * @param $lastDay
     * @param $datePoint
     * @return JsonResponse
     */
    public static function getPropertiesVisits($firstDay, $lastDay, $datePoint)
    {
        $dates = [];
        $visits = [];
        $uniqueVisits = [];

        $firstDayStart = $firstDay->startOfDay()->format('Y-m-d H:i:s');
        $lastDayEnd = $lastDay->endOfDay()->format('Y-m-d H:i:s');

        $start = 'startOf' . ucfirst($datePoint);
        $startDay = $firstDay->$start();

        $end = 'endOf' . ucfirst($datePoint);
        $endDay = $lastDay->$end();

        $period = CarbonPeriod::since($startDay)->{$datePoint}()->until($endDay);

        foreach ($period as $date) {
            array_push($dates,
                [
                    'start' => $date->$start()->format('Y-m-d H:i:s'),
                    'end' => $date->$end()->format('Y-m-d H:i:s'),
                ],
            );
        }

        if ($start === 'startOfWeek' || $start === 'startOfMonth') {
            $dates[0]['start'] = $firstDayStart;
        }

        if ($end === 'endOfWeek' || $end === 'endOfMonth') {
            $dates[count($dates) - 1]['end'] = $lastDayEnd;
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
