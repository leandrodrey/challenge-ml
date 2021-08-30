<?php

namespace App\Services;

use App\Domain\RawMessage;
use App\Domain\RestoredMessage;

class GetMessageService
{

    /**
     * Retorna el mensaje original tal cual lo envió el emisor
     *
     * @param array $satellites
     * @return string
     */
    public function getMessage(array $satellites): string
    {
        $messages = [];
        foreach ($satellites as $satellite) {
            $messages [] = new RawMessage($satellite["message"]);
        }
        $finalMessage = new RestoredMessage($messages);
        return $finalMessage->getFinalMessage();
    }

}
