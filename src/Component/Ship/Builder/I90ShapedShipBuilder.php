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
class I90ShapedShipBuilder extends AbstractShipBuilder
{
    /**
     * @param DeskInterface $desk
     * @return ShipInterface
     * @throws \Exception
     */
    public function build(DeskInterface $desk): ShipInterface
    {
        while (true) {
            $coordinateX = $this->generateCoordinate(1, 7);
            $coordinateY = $this->generateCoordinate();

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX, $coordinateY);

            if ($area !== null) {
                continue;
            }

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX + 1, $coordinateY);

            if ($area !== null) {
                continue;
            }

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX + 2, $coordinateY);

            if ($area !== null) {
                continue;
            }

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX + 3, $coordinateY);

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
        return ShipType::I90_SHAPED;
    }

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @throws AreaException
     */
    protected function createShipMargins(ShipInterface $ship, int $coordinateX, int $coordinateY): void
    {
        // top--1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY - 1);

        // top-0
        $this->createShipMarginArea($ship, $coordinateX, $coordinateY - 1);

        // top-1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY - 1);

        // top-2
        $this->createShipMarginArea($ship, $coordinateX + 2, $coordinateY - 1);

        // top-3
        $this->createShipMarginArea($ship, $coordinateX + 3, $coordinateY - 1);

        // top-4
        $this->createShipMarginArea($ship, $coordinateX + 4, $coordinateY - 1);

        // right
        $this->createShipMarginArea($ship, $coordinateX + 4, $coordinateY);

        // bottom-4
        $this->createShipMarginArea($ship, $coordinateX + 4, $coordinateY + 1);

        // bottom-3
        $this->createShipMarginArea($ship, $coordinateX + 3, $coordinateY + 1);

        // bottom-2
        $this->createShipMarginArea($ship, $coordinateX + 2, $coordinateY + 1);

        // bottom-1
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 1);

        // bottom-0
        $this->createShipMarginArea($ship, $coordinateX, $coordinateY + 1);

        // bottom---1
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 1);

        // left
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY);
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
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX, $coordinateY, $ship);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX + 1, $coordinateY, $ship);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX + 2, $coordinateY, $ship);
        $this->createArea($ship->getDesk(), AreaType::INTACT, $coordinateX + 3, $coordinateY, $ship);
    }
}
