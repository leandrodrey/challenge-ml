<?php

namespace App\Domain;

class RequestedSatellite
{
    /** @var string */
    private string $name;

    /** @var float  */
    private float $distance;

    /** @var string  */
    private string $message;

    function __construct(string $name, float $distance, string $message)
    {
        $this->name = $name;
        $this->distance = $distance;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}
