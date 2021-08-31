<?php

namespace App\Util\Trilateration;

class Point
{
    const EARTH_RADIUS = 6378137;

    protected $latitude;
    protected $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function latitude()
    {
        return $this->latitude;
    }

    public function longitude()
    {
        return $this->longitude;
    }

    public function __toString()
    {
        return "{$this->latitude},{$this->longitude}";
    }
}
