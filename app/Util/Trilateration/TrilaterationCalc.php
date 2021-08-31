<?php

namespace App\Util\Trilateration;

use App\Util\Trilateration\Point;
use App\Util\Trilateration\Sphere;

class TrilaterationCalc
{
    /** @var Sphere  */
    private Sphere $sphere1;
    /** @var Sphere */
    private Sphere $sphere2;
    /** @var Sphere */
    private Sphere $sphere3;

    /**
     * @param \App\Util\Trilateration\Sphere $sphere1
     * @param \App\Util\Trilateration\Sphere $sphere2
     * @param \App\Util\Trilateration\Sphere $sphere3
     */
    function __construct(Sphere $sphere1, Sphere $sphere2, Sphere $sphere3)
    {
        $this->sphere1 = $sphere1;
        $this->sphere2 = $sphere2;
        $this->sphere3 = $sphere3;
    }

    /**
     * @return Point
     */
    public function calculatePosition():Point {
        $x1 = $this->sphere1->getLatitude();
        $y1 = $this->sphere1->getLongitude();
        $r1 = $this->sphere1->getRadius();
        $x2 = $this->sphere2->getLatitude();
        $y2 = $this->sphere2->getLongitude();
        $r2 = $this->sphere2->getRadius();
        $x3 = $this->sphere3->getLatitude();
        $y3 = $this->sphere3->getLongitude();
        $r3 = $this->sphere3->getRadius();
        $A = 2*$x2 - 2*$x1;
        $B = 2*$y2 - 2*$y1;
        $C = pow($r1,2) - pow($r2,2) - pow($x1,2) + pow($x2,2) - pow($y1,2) + pow($y2,2);
        $D = 2*$x3 - 2*$x2;
        $E = 2*$y3 - 2*$y2;
        $F = pow($r2,2) - pow($r3,2) - pow($x2,2) + pow($x3,2) - pow($y2,2) + pow($y3,2);
        $x = ($C*$E - $F*$B) / ($E*$A - $B*$D);
        $y = ($C*$D - $A*$F) / ($B*$D - $A*$E);
        return new Point($x, $y);
    }
}
