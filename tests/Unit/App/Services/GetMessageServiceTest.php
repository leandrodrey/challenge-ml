<?php

namespace Tests\Unit\App\Services;

use App\Services\GetMessageService;
use PHPUnit\Framework\TestCase;

class GetMessageServiceTest extends TestCase
{

    /**
     * @dataProvider getMessageProvider
     */
    function test_getMessage($request, $expected){
        $getMessageService = new GetMessageService();
        self::assertSame($expected, $getMessageService->getMessage($request));
    }

    function getMessageProvider(): array
    {
        return [
            [
                "satellites" => [
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
                "este es un mensaje secreto"
            ],
            [
                "satellites" => [
                    [
                        "name" => "kenobi",
                        "distance" => 110,
                        "message" => ["", "", "pepito", "", "", "genio", ""]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 115.5,
                        "message" => ["", "es", "", "", "secreto"]
                    ],
                    [
                        "name" => "sato",
                        "distance" => 142.7,
                        "message" => ["pepito", "", "un", "genio", ""]
                    ]
                ],
                "pepito es un genio secreto"
            ]
        ];
    }

}

