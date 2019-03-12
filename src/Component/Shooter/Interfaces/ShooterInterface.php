<?php

namespace App\Component\Shooter\Interfaces;

use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;
use App\Interfaces\DeskInterface;

/**
 * Interface ShooterInterface
 * @package App\Component\Interfaces
 */
interface ShooterInterface
{
    /**
     * @param DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return ShootResultInterface
     */
    public function shoot(DeskInterface $desk, int $coordinateX, int $coordinateY): ShootResultInterface;
}
