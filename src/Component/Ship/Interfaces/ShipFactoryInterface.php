<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Constants\ShipType;
use App\Interfaces\DeskInterface;

/**
 * Interface ShipFactoryInterface
 * @package App\Component\Ship\Interfaces
 */
interface ShipFactoryInterface
{
    /**
     * @see ShipType
     * @param DeskInterface $desk
     * @param int $shipType A constant of {@see ShipType}
     * @return ShipInterface
     */
    public function build(DeskInterface $desk, int $shipType): ShipInterface;
}
