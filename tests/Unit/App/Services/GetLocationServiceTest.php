<?php

namespace Tests\Unit\App\Services;

use App\Domain\Satellite;
use App\Domain\SatelliteFactory;
use App\Services\GetLocationService;
use App\Util\Trilateration\Point;
use App\Util\Trilateration\Sphere;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

class GetLocationServiceTest extends TestCase
{

    /**
     * @dataProvider getSatelliteProvider
     */
    public function test_getLocation($requestedSatellites, $stubbedSpheres, $expected)
    {
        $satellite1 = $this->createMock(Satellite::class);
        $satellite1->method("createNewSphere")->willReturn($stubbedSpheres[0]);
        $satellite2 = $this->createMock(Satellite::class);
        $satellite2 ->method("createNewSphere")->willReturn($stubbedSpheres[1]);
        $satellite3 = $this->createMock(Satellite::class);
        $satellite3 ->method("createNewSphere")->willReturn($stubbedSpheres[2]);

        $factory = $this->createMock(SatelliteFactory::class);
        $factory->method("buildSatellites")->with($requestedSatellites)->willReturn([$satellite1, $satellite2, $satellite3]);
        $locationService = new GetLocationService($factory);

        self::assertEquals($expected, $locationService->getLocation($requestedSatellites));
    }

    /**
     * @return array[]
     */
    function getSatelliteProvider(): array
    {
        return [
            [
                [
                    [
                        "name" => "kenobi",
                        "distance" => 116.764720699,
                        "message" => ["este", "", "", "mensaje", ""],
                        "position" => [96,71]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 177.200451467,
                        "message" => ["", "es", "", "", "secreto"],
                        "position" => [107,148]
                    ],
                    [
                        "name" => "sato",
                        "distance" => 122.413234579,
                        "message" => ["este", "", "un", "", ""],
                        "position" => [118,30]
                    ]
                ],
                [
                    new Sphere(-96, 71, 116.764720699),
                    new Sphere(107, 148, 177.200451467),
                    new Sphere(118, -30, 122.413234579)
                ],
                new Point(0.9999999995511485, 5.999999999929179),
            ]
        ];
    }

}
