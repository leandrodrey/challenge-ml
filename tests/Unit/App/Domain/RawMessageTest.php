<?php

namespace Tests\Unit\App\Domain;

use App\Domain\RawMessage;
use PHPUnit\Framework\TestCase;

class RawMessageTest extends TestCase
{

    /**
     * @dataProvider countElementsProvider
     */
    function test_returnCountElements($message, $expected) {
        $rawMessage = new RawMessage($message);
        $countElements = $rawMessage->countElements();
        self::assertSame($expected, $countElements);
    }

    function countElementsProvider(): array
    {
        return [
            [["este", "", "", "mensaje", ""], 5],
            [["este", "", "", "mensaje"], 4],
            [["este"], 1],
            [[], 0]
        ];
    }

    /**
     * @dataProvider chopMessageProvider
     */
    function test_chopMessage($message, $size, $expected) {
        $rawMessage = new RawMessage($message);
        $rawMessage->chop($size);
        self::assertSame($expected, $rawMessage->getMessage());
    }

    function chopMessageProvider(): array
    {
        return [
            [["este", "", "", "mensaje", ""], 3, ["", "mensaje", ""]],
            [["", "", "este", "es", ""], 3, ["este", "es", ""]],
            [["", "", "", "mensaje", ""], 6, ["", "", "", "mensaje", ""]],
            [["", "", "", "mensaje", ""], 5, ["", "", "", "mensaje", ""]],
            [["", "", "", "mensaje", ""], 2, ["mensaje", ""]]
        ];
    }

}
