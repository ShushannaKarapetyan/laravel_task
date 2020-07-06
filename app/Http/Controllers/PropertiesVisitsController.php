<?php

namespace App\Http\Controllers;

use App\Visit;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
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
            $datePoint = 'day';

            return Visit::getPropertiesVisits($firstDay, $lastDay, $datePoint);
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

            $datePoint = 'day';

            switch (request('period')) {
                case 'lastSevenDays':
                    $firstDay = Carbon::now()->subDays(6);
                    $lastDay = Carbon::now();

                    break;

                case 'lastWeek':
                    $firstDay = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->startOfWeek();
                    $lastDay = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->endOfWeek();

                    break;

                case 'lastThirtyDays':
                    $firstDay = Carbon::now()->subDays(29);
                    $lastDay = Carbon::now();

                    break;

                case 'lastMonth':
                    $firstDay = Carbon::now()->subMonth()->startOfMonth();
                    $lastDay = Carbon::now()->subMonth()->endOfMonth();

                    break;

                case 'lastYearDays':
                    $firstDay = Carbon::now()->subDays(364);
                    $lastDay = Carbon::now();
                    $datePoint = 'week';

                    break;

                case 'lastYear':
                    $firstDay = Carbon::now()->subYear()->startOfYear();
                    $lastDay = Carbon::now()->subYear()->endOfYear();
                    $datePoint = 'week';

                    break;
            }

            if (request('customPeriod')) {
                $firstDay = (new Carbon(request('customPeriod')['customPeriodStart']))->copy()->addDays(1);
                $lastDay = (new Carbon(request('customPeriod')['customPeriodEnd']))->copy()->addDays(1);
            }

            return Visit::getPropertiesVisits($firstDay, $lastDay, $datePoint);
        }
    }

    /**
     * @return JsonResponse
     */
    public function changeInterval()
    {
        if (request()->ajax()) {

            switch (request('period')) {
                case 'lastSevenDays':
                    $firstDay = Carbon::now()->subDays(6);
                    $lastDay = Carbon::now();

                    break;

                case 'lastWeek':
                    $firstDay = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->startOfWeek();
                    $lastDay = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->endOfWeek();

                    break;

                case 'lastThirtyDays':
                    $firstDay = Carbon::now()->subDays(29);
                    $lastDay = Carbon::now();

                    break;

                case 'lastMonth':
                    $firstDay = Carbon::now()->subMonth()->startOfMonth();
                    $lastDay = Carbon::now()->subMonth()->endOfMonth();

                    break;

                case 'lastYearDays':
                    $firstDay = Carbon::now()->subDays(364);
                    $lastDay = Carbon::now();

                    break;

                case 'lastYear':
                    $firstDay = Carbon::now()->subYear()->startOfYear();
                    $lastDay = Carbon::now()->subYear()->endOfYear();

                    break;
            }

            switch (request('interval')) {
                case 'daily':
                    $datePoint = 'day';

                    break;

                case 'weekly':
                    $datePoint = 'week';

                    break;

                case 'monthly':
                    $datePoint = 'month';

                    break;
            }

            return Visit::getPropertiesVisits($firstDay, $lastDay, $datePoint);
        }
    }
}
