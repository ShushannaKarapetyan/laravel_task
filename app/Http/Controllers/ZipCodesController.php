<?php

namespace App\Http\Controllers;

use App\ZipCode;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ZipCodesController extends Controller
{
    /**
     * @return Factory|JsonResponse|View
     */
    public function index()
    {
        if (request()->ajax()) {
            $zipCodes = ZipCode::distinct()->pluck('zip');

            return Response::json([
                'zipCodes' => $zipCodes
            ]);
        }

        return view('zip-codes');
    }

    /**
     * @return JsonResponse
     */
    public function getTowns()
    {
        if (request()->ajax()) {
            $towns = ZipCode::where('zip', request()->zipCodeValue)->pluck('town');

            return Response::json([
                'towns' => $towns
            ]);
        }

        return $this->getTowns();
    }

    /**
     * @return JsonResponse
     */
    public function getDistrictState()
    {
        if (request()->ajax()) {
            $districtState = ZipCode::where([
                ['zip', request()->zipCodeValue],
                ['town', request()->selectedTown],
            ])->pluck('country', 'district');

            return Response::json([
                'districtState' => $districtState
            ]);
        }

        return $this->getDistrictState();
    }
}
