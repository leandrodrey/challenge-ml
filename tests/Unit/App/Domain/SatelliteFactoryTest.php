<?php

namespace Tests\Unit\App\Domain;

use App\Domain\Satellite;
use App\Domain\SatelliteFactory;
use Tests\TestCase;

class SatelliteFactoryTest extends TestCase
{

    /**
     * @dataProvider getSatellitesProvider
     */
    function test_buildSatellites($requestedSatellites, $expected)
    {
        $satelliteFactory = new SatelliteFactory();
        self::assertEquals($expected, $satelliteFactory->buildSatellites($requestedSatellites));
    }

    /**
     * @dataProvider getSatelliteProvider
    */
    function test_buildSatellite($requestedSatellite, $expected)
    {
        $satelliteFactory = new SatelliteFactory();
        self::assertEquals($expected, $satelliteFactory->buildSatellite($requestedSatellite["name"], $requestedSatellite["distance"], $requestedSatellite["message"]));
    }

    /**
     * @return array[]
     */
    function getSatellitesProvider(): array
    {
        return [
            [
                [
                    [
                        "name" => "kenobi",
                        "distance" => 116.764720699,
                        "message" => ["este", "", "", "mensaje", ""]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 177.200451467,
                        "message" => ["", "es", "", "", "secreto"]
                    ],
                    [
                        "name" => "sato",
                        "distance" => 122.413234579,
                        "message" => ["este", "", "un", "", ""]
                    ]
                ],
                [
                    new Satellite("kenobi", 116.764720699, ["este", "", "", "mensaje", ""], [-96, 71]),
                    new Satellite("skywalker", 177.200451467, ["", "es", "", "", "secreto"], [107, 148]),
                    new Satellite("sato", 122.413234579, ["este", "", "un", "", ""], [118, -30])
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    function getSatelliteProvider(): array
    {
        return [
            [
                [
                    "name" => "kenobi",
                    "distance" => 110,
                    "message" => ["este", "", "", "mensaje", ""]
                ],
                new Satellite("kenobi", 110, ["este", "", "", "mensaje", ""], [-96, 71]),
            ],
            [
                [
                    "name" => "skywalker",
                    "distance" => 110,
                    "message" => ["", "es", "", "", "secreto"]
                ],
                new Satellite("skywalker", 110, ["", "es", "", "", "secreto"], [107, 148])
            ],
            [
                [
                    "name" => "sato",
                    "distance" => 110,
                    "message" => ["pepito", "", "un", "genio", ""]
                ],
                new Satellite("sato", 110, ["pepito", "", "un", "genio", ""], [118, -30])
            ]
        ];
    }

}
