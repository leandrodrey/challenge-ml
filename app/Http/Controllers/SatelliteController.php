<?php

namespace App\Http\Controllers;

use App\Services\GetLocationService;
use App\Services\GetMessageService;
use App\Services\GetResponseFormatService;
use App\Services\SatelliteCrudService;
use App\Services\ValidateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SatelliteController extends Controller
{

    /** @var GetMessageService */
    private GetMessageService $getMessageService;
    /** @var GetLocationService */
    private GetLocationService $getLocationService;
    /** @var SatelliteCrudService */
    private SatelliteCrudService $satelliteCrudService;
    /** @var GetResponseFormatService */
    private GetResponseFormatService $getResponseFormatService;

    function __construct(
        GetMessageService $getMessageService,
        GetLocationService $getLocationService,
        SatelliteCrudService $satelliteCrudService,
        GetResponseFormatService $getResponseFormatService
    )
    {
        $this->getMessageService = $getMessageService;
        $this->getLocationService = $getLocationService;
        $this->satelliteCrudService = $satelliteCrudService;
        $this->getResponseFormatService = $getResponseFormatService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function topSecret(Request $request): JsonResponse
    {
        $satellites = $request->input("satellites");
        $finalMessage = $this->getMessageService->getMessage($satellites);
        $location = $this->getLocationService->getLocation($satellites);
        $response = $this->getResponseFormatService->getResponseFormat($location->latitude(), $location->longitude(), $finalMessage);
        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     * @param $satellite_name
     * @return JsonResponse
     */
    public function topSecretSplit(Request $request, $satellite_name): JsonResponse
    {
        $satelliteDistance = $request->input("distance");
        $satelliteMessage = $request->input("message");
        $this->satelliteCrudService->store($satellite_name, $satelliteDistance, $satelliteMessage);
        return response()->json("OK", 200);
    }

    /**
     * @return JsonResponse
     */
    public function getTopSecretSplit(): JsonResponse
    {
        $satellites = $this->satelliteCrudService->index();
        if (count($satellites) < 3) {
            return response()->json("Not enough satellites to calculate location and message", 404);
        }
        $finalMessage = $this->getMessageService->getMessage($satellites);
        $location = $this->getLocationService->getLocation($satellites);
        $response = $this->getResponseFormatService->getResponseFormat($location->latitude(), $location->longitude(), $finalMessage);
        return response()->json($response, 200);
    }

}
