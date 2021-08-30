<?php

namespace App\Domain;

class SatelliteFactory
{

    /** @var array|float[][] */
    static array $satellitePosition = [
        "kenobi" => [60.1695,24.9354],
        "skywalker" => [58.3806, 26.7251],
        "sato" => [58.3859, 24.4971]
    ];

    /**
     * Genera un array de Satellites
     *
     * @param array $requestedSatellites
     * @return array
     */
    public function buildSatellites(array $requestedSatellites):array {
        $satellites = [];
        foreach ($requestedSatellites as $satellite) {
            $satellites [] = $this->buildSatellite($satellite["name"], $satellite["distance"], $satellite["message"]);
        }
        return $satellites;
    }

    /**
     * Solo construye un Satellite
     *
     * @param string $satelliteName
     * @param float $satelliteDistance
     * @param array $satelliteMessage
     * @return Satellite
     */
    public function buildSatellite(string $satelliteName, float $satelliteDistance, array $satelliteMessage): Satellite
    {
        return new Satellite($satelliteName, $satelliteDistance, $satelliteMessage, self::$satellitePosition[$satelliteName]);
    }

}
