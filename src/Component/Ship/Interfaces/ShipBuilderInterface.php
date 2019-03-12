<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Constants\ShipType;
use App\Interfaces\DeskInterface;

/**
 * Interface ShipBuilderInterface
 * @package App\Component\Ship\Interfaces
 */
interface ShipBuilderInterface
{
    /**
     * @param DeskInterface $desk
     * @return ShipInterface
     */
    public function build(DeskInterface $desk): ShipInterface;

    /**
     * @see ShipType
     * @param int $shipType A constant of {@see ShipType}
     * @return bool
     */
    public function canBuild(int $shipType): bool;
}
