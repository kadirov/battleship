<?php

namespace App\Component\Interfaces;

use App\Entity\Area;

interface ShooterInterface
{
    public function shoot(int $coordinateX, int $coordinateY): Area;
}
