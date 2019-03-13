<?php declare(strict_types=1);

namespace App\Component\Area\Interfaces;

use App\Component\Desk\Interfaces\DeskInterface;

/**
 * Interface AreaBuilderInterface
 * @package App\Component\Area\Interfaces
 */
interface AreaBuilderInterface
{
    /**
     * @see \App\Component\Area\Constants\AreaType
     * @param \App\Component\Desk\Interfaces\DeskInterface $desk
     * @param int $type A constant of {@see AreaType}
     * @param int $coordinateX
     * @param int $coordinateY
     * @return AreaInterface
     */
    public function build(\App\Component\Desk\Interfaces\DeskInterface $desk, int $type, int $coordinateX, int $coordinateY): AreaInterface;
}
