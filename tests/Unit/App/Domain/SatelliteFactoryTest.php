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
    function test_buildSatellites($requestedSatellites, $expected) {
        $satelliteFactory = new SatelliteFactory();
        print_r($expected);
        self::assertEquals($expected, $satelliteFactory->buildSatellites($requestedSatellites));
     }

    function test_buildSatellite() {

    }

    function getSatellitesProvider()
    {
        return [
            [
                [
                    [
                        "name" => "kenobi",
                        "distance" => 110,
                        "message" => ["este", "", "", "mensaje", ""]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 115.5,
                        "message" => ["", "es", "", "", "secreto"]
                    ],
                    [
                        "name" => "sato",
                        "distance" => 142.7,
                        "message" => ["este", "", "un", "", ""]
                    ]
                ],
                /*[
                    $this->getMockBuilder(Satellite::class)->setConstructorArgs(["kenobi", 110, ["este", "", "", "mensaje", ""], [60.1695,24.9354]])->getMock(),
                    $this->getMockBuilder(Satellite::class)->setConstructorArgs(["skywalker", 115.5, ["", "es", "", "", "secreto"], [58.3806, 26.7251]])->getMock(),
                    $this->getMockBuilder(Satellite::class)->setConstructorArgs(["sato", 142.7, ["este", "", "un", "", ""], [58.3859, 24.4971]])->getMock()
                ]*/
                [
                    new Satellite("kenobi", 110, ["este", "", "", "mensaje", ""], [60.1695,24.9354]),
                    new Satellite("skywalker", 115.5, ["", "es", "", "", "secreto"], [58.3806, 26.7251]),
                    new Satellite("sato", 142.7, ["este", "", "un", "", ""], [58.3859, 24.4971])
                ]
            ],
            [
                [
                    [
                        "name" => "kenobi",
                        "distance" => 81175,
                        "message" => ["", "", "pepito", "", "", "genio", ""]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 162311,
                        "message" => ["", "es", "", "", "secreto"]
                    ],
                    [
                        "name" => "sato",
                        "distance" => 116932,
                        "message" => ["pepito", "", "un", "genio", ""]
                    ]
                ],
                [
                    new Satellite("kenobi", 81175, ["", "", "pepito", "", "", "genio", ""], [60.1695,24.9354]),
                    new Satellite("skywalker", 162311, ["", "es", "", "", "secreto"], [58.3806, 26.7251]),
                    new Satellite("sato", 116932, ["pepito", "", "un", "genio", ""], [58.3859, 24.4971])
                ]
            ]
        ];
    }

}
