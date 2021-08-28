<?php

namespace App\Domain;

use JetBrains\PhpStorm\Pure;

class RestoredMessage
{
    /** @var array */
    private array $cleanedMessages;

    /**
     * @param array $rawMessages
     */
    public function __construct(array $rawMessages)
    {
        $minSize = $this->minSize($rawMessages);
        $chopedMessages = $this->chopMessages($rawMessages, $minSize);
        $this->cleanedMessages = $this->cleanMessages($chopedMessages);
    }

    /**
     * Este método retornará el mensaje final según los arrays enviados
     *
     * @return string
     */
    public function getFinalMessage(): string
    {
        $finalMessageArr = array_replace_recursive($this->cleanedMessages[0], $this->cleanedMessages[1], $this->cleanedMessages[2]);
        ksort($finalMessageArr);
        return implode(" ", $finalMessageArr);
    }

    /**
     * Este método devuelve cuál es el tamaño mínimo de elementos de un array de una lista de arrays
     *
     * @param $rawMessages
     * @return int
     */
    private function minSize($rawMessages): int
    {
        $messageSize = [];
        foreach ($rawMessages as $rawMessage) {
            $messageSize [] = $rawMessage->countElements();
        }
        return min($messageSize);
    }

    /**
     * Este método elimina los X primeros elementos de un array según el $size que se le pasee
     *
     * @param $rawMessages
     * @param $size
     * @return array
     */
    private function chopMessages($rawMessages, $size): array
    {
        foreach ($rawMessages as $rawMessage) {
            $rawMessage->chop($size);
        }
        return $rawMessages;
    }

    /**
     * Este método limpia los elementos del array que sean strings vacíos
     *
     * @param $rawMessages
     * @return array
     */
    private function cleanMessages($rawMessages): array
    {
        $cleanedMessages = [];
        foreach ($rawMessages as $rawMessage) {
            $cleanedMessages [] = $rawMessage->cleanMessage();
        }
        return $cleanedMessages;
    }

}
