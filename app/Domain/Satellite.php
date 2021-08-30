<?php

namespace App\Domain;

use App\Util\Trilateration\Sphere;

class Satellite
{
    /** @var string */
    private string $name;

    /** @var float  */
    private float $distance;

    /** @var array  */
    private array $message;

    /** @var array  */
    private array $position;

    function __construct(string $name, float $distance, array $message, array $position)
    {
        $this->name = $name;
        $this->distance = $distance;
        $this->message = $message;
        $this->position = $position;
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
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getPosition(): array
    {
        return $this->position;
    }

    /**
     * Crea una nueva Sphere utilizando la posición y la distancia
     *
     * @return Sphere
     */
    public function createNewSphere(): Sphere {
        return new Sphere($this->position[0], $this->position[1], $this->distance);
    }

}
