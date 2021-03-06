<?php declare(strict_types=1);

namespace App\Component\Ship\Builder;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Exceptions\AreaException;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Constants\ShipType;
use App\Component\Ship\Interfaces\ShipInterface;

/**
 * Class DotShapedShipBuilder
 * @package App\Component\Ship\Builder
 */
class DotShapedShipBuilder extends AbstractShipBuilder
{
    /**
     * @param \App\Component\Desk\Interfaces\DeskInterface $desk
     * @return ShipInterface
     * @throws \Exception
     */
    public function build(DeskInterface $desk): ShipInterface
    {
        $coordinateX = 0;
        $coordinateY = 0;

        while (true) {
            $coordinateX = $this->generateCoordinate();
            $coordinateY = $this->generateCoordinate();

            $area = $this->getDeskManager()->getAreaByCoordinates($desk, $coordinateX, $coordinateY);

            if ($area === null) {
                break;
            }
        }

        return $this->buildParts($desk, $coordinateX, $coordinateY);
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

        // top-right
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY - 1);

        // right
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY);

        // right-bottom
        $this->createShipMarginArea($ship, $coordinateX + 1, $coordinateY + 1);

        // bottom
        $this->createShipMarginArea($ship, $coordinateX, $coordinateY + 1);

        // bottom-left
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY + 1);

        // left
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY);

        // left-top
        $this->createShipMarginArea($ship, $coordinateX - 1, $coordinateY - 1);
    }

    /**
     * @see ShipType
     * @return int A constant of {@see ShipType}
     */
    protected function getType(): int
    {
        return ShipType::DOT_SHAPED;
    }
}
