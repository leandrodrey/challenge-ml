<?php

namespace App\Services;

use App\Domain\Satellite;
use App\Domain\SatelliteFactory;
use App\Util\Trilateration\Point;
use App\Util\Trilateration\TrilaterationCalc;

class GetLocationService
{

    /** @var SatelliteFactory */
    private SatelliteFactory $factory;

    public function __construct(SatelliteFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Retorna la posición del emisor del mensaje
     *
     * @param array $requestedSatellites
     * @return Point
     */
    function getLocation(array $requestedSatellites): Point
    {
        $satellites = $this->factory->buildSatellites($requestedSatellites);
        $trilateration = new TrilaterationCalc($satellites[0]->createNewSphere(), $satellites[1]->createNewSphere(), $satellites[2]->createNewSphere());
        return $trilateration->calculatePosition();
    }

}
