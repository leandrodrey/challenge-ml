<?php

namespace App\Services;

use App\Domain\Satellite;
use App\Domain\RequestedSatellite;
use App\Domain\SatelliteFactory;
use App\Util\Trilateration\Intersection;
use App\Util\Trilateration\Point;

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
        $trilateration = new Intersection($satellites[0]->createNewSphere(), $satellites[1]->createNewSphere(), $satellites[2]->createNewSphere());
        return $trilateration->position();
    }

}
