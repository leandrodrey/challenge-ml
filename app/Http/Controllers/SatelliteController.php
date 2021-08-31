<?php

namespace App\Http\Controllers;

use App\Services\GetLocationService;
use App\Services\GetMessageService;
use App\Services\GetResponseFormatService;
use App\Services\SatelliteCrudService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API Fuego de Quasar",
 *     version="1.0",
 *     description="Challenge MELI",
 *     @OA\Contact(
 *          email="leandrodrey@gmail.com"
 *     ),
 * )
 *
 * @OA\Server(
 *     url="https://exterionmu.com:2083",
 *     description="Servidor Online"
 * )
 *
 * @OA\Tag(
 *     name="Endpoints",
 *     description=""
 * )
 *
 */
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
        GetMessageService        $getMessageService,
        GetLocationService       $getLocationService,
        SatelliteCrudService     $satelliteCrudService,
        GetResponseFormatService $getResponseFormatService
    )
    {
        $this->getMessageService = $getMessageService;
        $this->getLocationService = $getLocationService;
        $this->satelliteCrudService = $satelliteCrudService;
        $this->getResponseFormatService = $getResponseFormatService;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/topsecret",
     *      operationId="topsecret",
     *      tags={"topsecret"},
     *      summary="GetMessage and GetLocation",
     *      description="Nivel 2. Retorna el mensaje y la locación del Emisor del Mensaje",
     *      @OA\RequestBody(
     *          request="VehicleStoreRequestBody",
     *          description="Json",
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="satellites", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="name",type="string", example="kenobi"),
     *                      @OA\Property(property="distance",type="float", example="81175.77"),
     *                      @OA\Property(property="message",type="array",
     *                          @OA\Items(type="string",example={"este", "", "", "mensaje", ""})
     *                      )
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(
     *              @OA\Property(property="position", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="x",type="float", example="-100"),
     *                      @OA\Property(property="y",type="float", example="81175.77")
     *                  )
     *             ),
     *             @OA\Property(property="message",type="string", example="este es un mensaje secreto"),
     *         ),
     *     )
     * )
     *
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
     * @OA\Post(
     *      path="/api/v2/topsecret_split/{satellite_name}",
     *      operationId="topsecretsplit",
     *      tags={"topsecret_split"},
     *      summary="Envía y guarda un satelite",
     *      description="Nivel 3. Por cada post enviaremos los datos de un satelite",
     *     @OA\Parameter(
     *          name="satellite_name",
     *          description="Nombre del satelite para el cuál vamos a enviar la información",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          request="VehicleStoreRequestBody",
     *          description="Json",
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="distance", type="float", example=81175),
     *              @OA\Property(
     *                  property="message",
     *                  type="array",
     *                  @OA\Items(type="string",example={"este", "", "", "mensaje", ""})
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     *     )
     *
     * @param Request $request
     * @param $satellite_name
     * @return JsonResponse
     */
    public function topSecretSplit(Request $request, $satellite_name): JsonResponse
    {
        $satelliteDistance = $request->input("distance");
        $satelliteMessage = $request->input("message");
        $this->satelliteCrudService->store($satellite_name, $satelliteDistance, $satelliteMessage);
        return response()->json("Successful operation", 200);
    }

    /**
     * @OA\Get(
     *      path="/api/v2/topsecret_split",
     *      operationId="getTopSecretSplit",
     *      tags={"topsecret_split"},
     *      summary="GetMessage and GetLocation",
     *      description="Nivel 3. Retorna el mensaje y la locación del Emisor del Mensaje si se tiene la información correcta",
     *      @OA\Response(
     *          response=200,
     *          description="Retorna el mensaje y la locación del Emisor del Mensaje",
     *          @OA\JsonContent(ref="/app/components/SatelliteResponse")
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Devuelve un Error si no es posible determinar los datos con la información
     *          actual.",
     *          @OA\JsonContent(ref="/app/components/SatelliteResponse")
     *       )
     *     )
     *
     * @return JsonResponse
     */
    public function getTopSecretSplit(): JsonResponse
    {
        $satellites = $this->satelliteCrudService->index();
        if (count($satellites) < 3) {
            return response()->json("There are not enough satellites to calculate the location and message", 404);
        }
        $finalMessage = $this->getMessageService->getMessage($satellites);
        $location = $this->getLocationService->getLocation($satellites);
        $response = $this->getResponseFormatService->getResponseFormat($location->latitude(), $location->longitude(), $finalMessage);
        return response()->json($response, 200);
    }

}
