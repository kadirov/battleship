<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Component\Desk\Interfaces\DeskInterface;

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

    /**
     * @param ShipInterface $ship
     */
    public function save(ShipInterface $ship): void;

    /**
     * @param DeskInterface $desk
     * @return bool
     */
    public function isAllShipsSink(DeskInterface $desk): bool;
}
