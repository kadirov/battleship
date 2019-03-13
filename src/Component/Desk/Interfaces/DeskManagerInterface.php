<?php

namespace App\Component\Desk\Interfaces;

use App\Component\Area\Interfaces\AreaInterface;

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
