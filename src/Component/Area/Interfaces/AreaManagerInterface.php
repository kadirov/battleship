<?php declare(strict_types=1);

namespace App\Component\Area\Interfaces;

use App\Component\Area\Exceptions\AreaException;

/**
 * Interface AreaManagerInterface
 * @package App\Component\Area\Interfaces
 */
interface AreaManagerInterface
{
    /**
     * @param AreaInterface $area
     * @throws AreaException Method throws this exception if area has wrong coordinates
     */
    public function save(AreaInterface $area): void;

    /**
     * @param int $coordinateX
     * @param int $coordinateY
     * @return bool
     */
    public function isValidCoordinates(int $coordinateX, int $coordinateY): bool;
}
