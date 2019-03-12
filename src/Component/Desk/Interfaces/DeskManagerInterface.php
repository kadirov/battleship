<?php

namespace App\Component\Desk\Interfaces;

use App\Interfaces\AreaInterface;
use App\Interfaces\DeskInterface;

/**
 * Interface DeskManagerInterface
 * @package App\Component\Desk\Interfaces
 */
interface DeskManagerInterface
{
    /**
     * @param DeskInterface $desk
     */
    public function save(DeskInterface $desk): void;

    /**
     * @param DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return AreaInterface|null
     */
    public function getAreaByCoordinates(DeskInterface $desk, int $coordinateX, int $coordinateY): ?AreaInterface;
}
