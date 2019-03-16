<?php

namespace App\Component\Desk\Interfaces;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Game\Interfaces\GameInterface;

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

    /**
     * Get game->desktop by {@see UserType}
     *
     * @see UserType
     * @param GameInterface $game
     * @param int $userType A constant of {@see UserType}
     * @return DeskInterface|null
     */
    public function getByType(GameInterface $game, int $userType): ?DeskInterface;
}
