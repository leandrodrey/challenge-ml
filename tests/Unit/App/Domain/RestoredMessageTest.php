<?php

namespace Tests\Unit\App\Domain;

use App\Domain\RawMessage;
use App\Domain\RestoredMessage;
use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;

class RestoredMessageTest extends TestCase
{

    /**
     * @dataProvider getMessageProvider
     */
    function test_getMessages($rawMessages, $expected)
    {
        $message = new RestoredMessage($rawMessages);
        self::assertSame($expected, $message->getFinalMessage());
    }

    function getMessageProvider(): array
    {
        return [
            [
                [
                    new RawMessage(["este", "", "", "mensaje", ""]),
                    new RawMessage(["", "es", "", "", "secreto"]),
                    new RawMessage(["este", "", "un", "", ""])
                ],
                "este es un mensaje secreto"
            ],
            [
                [
                    new RawMessage(["", "", "", "pepito", "", "", "genio", ""]),
                    new RawMessage(["", "", "es", "", "", "secreto"]),
                    new RawMessage(["pepito", "", "un", "genio", ""])
                ],
                "pepito es un genio secreto"
            ]
        ];
    }

}
