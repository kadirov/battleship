<?php declare(strict_types=1);

namespace App\Component\Ship\Builder;

use App\Component\Area\Constants\AreaType;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Constants\ShipType;
use App\Component\Ship\Interfaces\ShipInterface;

class LShapedShipBuilder extends AbstractShipBuilder
{
    /**
     * @see ShipType
     * @return int A constant of {@see ShipType}
     */
    protected function getType(): int
    {
        return ShipType::L_SHAPED;
    }

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @throws \App\Component\Area\Exceptions\AreaException
     */
    protected function createShipMargins(ShipInterface $ship, int $coordinateX, int $coordinateY): void
    {
        // top--1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY - 1);

        // top-0
        $this->createShipMarginArea($ship, $coordinateX, $coordinateY - 1);

        // top-1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY - 1);

        // right-0
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY);

        // right-1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 1);

        // right-1-
        $this->createShipMarginArea($ship, $coordinateX + 2, $coordinateY + 1);

        // right-1--
        $this->createShipMarginArea($ship, $coordinateX + 3, $coordinateY + 1);

        // right-2--
        $this->createShipMarginArea($ship, $coordinateX + 3, $coordinateY + 2);

        // bottom-3
        $this->createShipMarginArea($ship, $coordinateX + 3, $coordinateY + 3);

        // bottom-2
        $this->createShipMarginArea($ship, $coordinateX + 2, $coordinateY + 3);

        // bottom-1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 3);

        // bottom-0
        $this->createShipMarginArea($ship, $coordinateX + 0, $coordinateY + 3);

        // bottom--1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 3);

        // left-2
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 2);

        // left-1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 1);

        // left-0
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY);
    }

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @return void
     * @throws \App\Component\Area\Exceptions\AreaException
     */
    protected function createShipArea(ShipInterface $ship, int $coordinateX, int $coordinateY): void
    {
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY + 1);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY + 2);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX + 1, $coordinateY + 2);
    }

    /**
     * @param DeskInterface $desk
     * @return ShipInterface
     * @throws \Exception
     */
    public function build(DeskInterface $desk): ShipInterface
    {
        while (true) {
            $coordinateX = $this->generateCoordinate(1, 9);
            $coordinateY = $this->generateCoordinate(1, 8);

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

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX + 1, $coordinateY + 2);

            if ($area === null) {
                break;
            }
        }

        return $this->buildParts($desk, $coordinateX, $coordinateY);
    }
}
