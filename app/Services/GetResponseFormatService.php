<?php

namespace App\Services;

class GetResponseFormatService
{

    /**
     * Este método modela el formato de la respuesta
     *
     * @param $x
     * @param $y
     * @param $message
     * @return array
     */
    public function getResponseFormat($x, $y, $message):array
    {
        return [
            "position" => [
                "x" => $x,
                "y" => $y
            ],
            "message" => $message
        ];
    }

}
