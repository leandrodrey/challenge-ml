<?php

namespace App\Services;

use App\Models\Satellites;
use Illuminate\Contracts\Foundation\Application;
use App\Domain\SatelliteFactory;

class SatelliteCrudService
{

    /** @var SatelliteFactory */
    private SatelliteFactory $factory;

    public function __construct(SatelliteFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return array
     */
    public function index(): array
    {
        $satellites = Satellites::orderBy('id', 'desc')->limit(3)->get();
        return $satellites->toArray();
    }

    /**
     * Store a newly created Satellite in storage.
     *
     * @param string $satellite_name
     * @param float $satelliteDistance
     * @param array $satelliteMessage
     */
    public function store(string $satellite_name, float $satelliteDistance, array $satelliteMessage)
    {
        $satellite = $this->factory->buildSatellite($satellite_name, $satelliteDistance, $satelliteMessage);
        $satelliteModel = new Satellites();
        $satelliteModel->name = $satellite->getName();
        $satelliteModel->distance = $satellite->getDistance();
        $satelliteModel->message = serialize($satellite->getMessage());
        $satelliteModel->position = serialize($satellite->getPosition());
        $satelliteModel->save();
    }

}
