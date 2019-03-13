<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Component\Area\Interfaces\AreaInterface;

/**
 * Interface ShipManagerInterface
 * @package App\Component\Ship\Interfaces
 */
interface ShipManagerInterface
{
    /**
     * Returns true if all parts of ship are HIT
     *
     * @see \App\Component\Area\Interfaces\AreaInterface
     * @param ShipInterface $ship
     * @return bool
     */
    public function isSink(ShipInterface $ship): bool;

    /**
     * @param ShipInterface $ship
     */
    public function save(ShipInterface $ship): void;
}
