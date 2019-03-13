<?php

namespace App\Component\Shooter\Interfaces;

use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;

/**
 * Interface ShooterInterface
 * @package App\Component\Interfaces
 */
interface ShooterInterface
{
    /**
     * @param \App\Component\Desk\Interfaces\DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return ShootResultInterface
     */
    public function shoot(\App\Component\Desk\Interfaces\DeskInterface $desk, int $coordinateX, int $coordinateY): ShootResultInterface;
}
