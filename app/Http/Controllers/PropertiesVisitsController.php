<?php

namespace App\Http\Controllers;

use App\Visit;
use Carbon\CarbonPeriod;
use Exception;
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
            $firstDay = Carbon::now()->firstOfMonth();
            $lastDay = Carbon::now()->lastOfMonth();

            return Visit::getPropertiesVisits($firstDay, $lastDay);
        }

        return view('property.visits');
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function period()
    {
        if (request()->ajax()) {
            switch (request('period')) {
                case 'lastSevenDays':
                    $firstDay = Carbon::now()->subDays(6);
                    $lastDay = Carbon::now();

                    return Visit::getPropertiesVisits($firstDay, $lastDay);
                    break;

                case 'lastWeek':
                    $firstDay = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->startOfWeek();
                    $lastDay = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->endOfWeek();

                    return Visit::getPropertiesVisits($firstDay, $lastDay);
                    break;

                case 'lastThirtyDays':
                    $firstDay = Carbon::now()->subDays(29);
                    $lastDay = Carbon::now();

                    return Visit::getPropertiesVisits($firstDay, $lastDay);
                    break;

                case 'lastMonth':
                    $firstDay = Carbon::now()->subMonth()->startOfMonth();
                    $lastDay = Carbon::now()->subMonth()->endOfMonth();

                    return Visit::getPropertiesVisits($firstDay, $lastDay);
                    break;

                case 'lastYearDays':
                    $firstDay = Carbon::now()->subDays(364);
                    $lastDay = Carbon::now();

                    return Visit::getPropertiesVisits($firstDay, $lastDay);
                    break;

                case 'lastYear':
                    $firstDay = Carbon::now()->subYear()->startOfYear();
                    $lastDay = Carbon::now()->subYear()->endOfYear();

                    return Visit::getPropertiesVisits($firstDay, $lastDay);
                    break;
            }

            if (request('customPeriodStart') && request('customPeriodEnd')) {
                $firstDay = (new Carbon(request('customPeriodStart')))->copy()->addDays(1);
                $lastDay = (new Carbon(request('customPeriodEnd')))->copy()->addDays(1);

                return Visit::getPropertiesVisits($firstDay, $lastDay);
            }
        }

        return $this->period();
    }
}
