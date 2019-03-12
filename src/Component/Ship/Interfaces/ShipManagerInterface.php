<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Interfaces\AreaInterface;

/**
 * Interface ShipManagerInterface
 * @package App\Component\Ship\Interfaces
 */
interface ShipManagerInterface
{
    /**
     * Returns true if all parts of ship are HIT
     *
     * @see AreaInterface
     * @param ShipInterface $ship
     * @return bool
     */
    public function isSink(ShipInterface $ship): bool;
}
