<?php

namespace Tests\Unit\App\Domain;

use App\Domain\Satellite;
use App\Util\Trilateration\Sphere;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

class SatelliteTest extends TestCase
{

   function test_createNewSphere() {
        $satellite = new Satellite("kenobi", 81175, ["este", "", "", "mensaje", ""], [60.1695,24.9354]);
        $expected = new Sphere(60.1695, 24.9354, 81175);
        self::assertEquals($expected, $satellite->createNewSphere());
   }

}
