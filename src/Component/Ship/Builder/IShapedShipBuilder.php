<?php declare(strict_types=1);

namespace App\Component\Ship\Builder;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Exceptions\AreaException;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Constants\ShipType;
use App\Component\Ship\Interfaces\ShipInterface;

/**
 * Class IShapedShipBuilder
 * @package App\Component\Ship\Builder
 */
class IShapedShipBuilder extends AbstractShipBuilder
{
    /**
     * @param DeskInterface $desk
     * @return ShipInterface
     * @throws \Exception
     */
    public function build(DeskInterface $desk): ShipInterface
    {
        $coordinateX = 0;
        $coordinateY = 0;

        while (true) {
            $coordinateX = $this->generateCoordinate();
            $coordinateY = $this->generateCoordinate(1, 7);

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX, $coordinateY);

            if ($area !== null) {
                continue;
            }

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX, $coordinateY + 1);

            if ($area !== null) {
                continue;
            }

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX, $coordinateY + 2);

            if ($area !== null) {
                continue;
            }

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX, $coordinateY + 3);

            if ($area === null) {
                break;
            }
        }

        return $this->buildParts($desk, $coordinateX, $coordinateY);
    }

    /**
     * @see ShipType
     * @return int A constant of {@see ShipType}
     */
    protected function getType(): int
    {
        return ShipType::I_SHAPED;
    }

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @throws AreaException
     */
    protected function createShipMargins(ShipInterface $ship, int $coordinateX, int $coordinateY): void
    {
        // top
        $this->createShipMarginArea($ship, $coordinateX, $coordinateY - 1);

        // top-right--1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY - 1);

        // right-0
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY);

        // right-1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 1);

        // right-2
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 2);

        // right-3
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 3);

        // right-4
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 4);

        // bottom
        $this->createShipMarginArea($ship, $coordinateX, $coordinateY + 4);

        // left-4
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 4);

        // left-3
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 3);

        // left-2
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 2);

        // left-1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 1);

        // left-0
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY);

        // left--1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY - 1);
    }

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @return void
     * @throws AreaException
     */
    protected function createShipArea(ShipInterface $ship, int $coordinateX, int $coordinateY): void
    {
        if ($ship->getDesk() === null) {
            throw new \LogicException('Ship must have a desk');
        }

        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY, $ship);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY + 1, $ship);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY + 2, $ship);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY + 3, $ship);
    }
}
