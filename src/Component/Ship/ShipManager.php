<?php declare(strict_types=1);

namespace App\Component\Ship;

use App\Component\Ship\Interfaces\ShipInterface;
use App\Component\Ship\Interfaces\ShipManagerInterface;

class ShipManager implements ShipManagerInterface
{
    /**
     * Returns true if all parts of ship are HIT
     *
     * @see AreaInterface
     * @param ShipInterface $ship
     * @return bool
     */
    public function isSink(ShipInterface $ship): bool
    {
        // TODO: Implement isSink() method.
    }
}
