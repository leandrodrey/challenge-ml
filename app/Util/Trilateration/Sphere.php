<?php

namespace App\Util\Trilateration;

use App\Util\Trilateration\Point;

class Sphere extends Point
{
    protected $radius;

    public function __construct($latitude, $longitude, $radius)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->radius = $radius;
    }

    public function radius()
    {
        return $this->radius;
    }

    public function __toString()
    {
        return "{$this->latitude},{$this->longitude},{$this->radius}";
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getRadius()
    {
        return $this->radius;
    }


}
