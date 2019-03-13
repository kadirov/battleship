<?php declare(strict_types=1);

namespace App\Component\Ship\Builder;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Exceptions\AreaException;
use App\Component\Area\Interfaces\AreaBuilderInterface;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Area\Interfaces\AreaManagerInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Ship\Constants\ShipStatus;
use App\Component\Ship\Constants\ShipType;
use App\Component\Ship\Interfaces\ShipBuilderInterface;
use App\Component\Ship\Interfaces\ShipInterface;
use App\Component\Ship\Interfaces\ShipManagerInterface;
use App\Entity\Ship;

/**
 * Class AbstractShipBuilder
 * @package App\Component\Ship\Builder
 */
abstract class AbstractShipBuilder implements ShipBuilderInterface
{
    /**
     * @var DeskManagerInterface
     */
    private $deskManager;

    /**
     * @var AreaBuilderInterface
     */
    private $areaBuilder;

    /**
     * @var AreaManagerInterface
     */
    private $areaManager;

    /**
     * @var ShipManagerInterface
     */
    private $shipManager;

    /**
     * DotShapedShipBuilder constructor.
     * @param DeskManagerInterface $deskManager
     * @param AreaBuilderInterface $areaBuilder
     * @param AreaManagerInterface $areaManager
     * @param ShipManagerInterface $shipManager
     */
    public function __construct
    (
        DeskManagerInterface $deskManager,
        AreaBuilderInterface $areaBuilder,
        AreaManagerInterface $areaManager,
        ShipManagerInterface $shipManager
    ) {
        $this->deskManager = $deskManager;
        $this->areaBuilder = $areaBuilder;
        $this->areaManager = $areaManager;
        $this->shipManager = $shipManager;
    }

    /**
     * @see ShipType
     * @param int $shipType A constant of {@see ShipType}
     * @return bool
     */
    public function canBuild(int $shipType): bool
    {
        return $shipType === $this->getType();
    }

    /**
     * @return AreaBuilderInterface
     */
    protected function getAreaBuilder(): AreaBuilderInterface
    {
        return $this->areaBuilder;
    }

    /**
     * @return AreaManagerInterface
     */
    protected function getAreaManager(): AreaManagerInterface
    {
        return $this->areaManager;
    }

    /**
     * @return DeskManagerInterface
     */
    protected function getDeskManager(): DeskManagerInterface
    {
        return $this->deskManager;
    }

    /**
     * @return ShipManagerInterface
     */
    protected function getShipManager(): ShipManagerInterface
    {
        return $this->shipManager;
    }

    /**
     * @see ShipType
     * @return int A constant of {@see ShipType}
     */
    abstract protected function getType(): int;

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     */
    abstract protected function createShipMargins(ShipInterface $ship, int $coordinateX, int $coordinateY): void;

    /**
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @return void
     */
    abstract protected function createShipArea(ShipInterface $ship, int $coordinateX, int $coordinateY): void;

    /**
     * @param DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return ShipInterface
     */
    protected function buildParts(DeskInterface $desk, int $coordinateX, int $coordinateY): ShipInterface
    {
        $ship = $this->createShip($desk);
        $this->createShipArea($ship, $coordinateX, $coordinateY);
        $this->createShipMargins($ship, $coordinateX, $coordinateY);

        return $ship;
    }

    /**
     * @param DeskInterface $desk
     * @return ShipInterface
     */
    protected function createShip(DeskInterface $desk): ShipInterface
    {
        $ship = new Ship();
        $ship->setDesk($desk);
        $ship->setType($this->getType());
        $ship->setStatus(ShipStatus::UNBROKEN);
        $this->getShipManager()->save($ship);

        return $ship;
    }

    /**
     * Create ship margins if coordinates are valid coordinated
     *
     * @param ShipInterface $ship
     * @param int $coordinateX
     * @param int $coordinateY
     * @throws AreaException
     */
    protected function createShipMarginArea(ShipInterface $ship, int $coordinateX, int $coordinateY): void
    {
        if ($this->getAreaManager()->isValidCoordinates($coordinateX, $coordinateY)) {
            $this->createArea($ship->getDesk(), AreaType::SHIP_MARGIN, $coordinateX, $coordinateY);
        }
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     * @throws \Exception
     */
    protected function generateCoordinate(int $min = 1, int $max = 10): int
    {
        return \random_int($min, $max);
    }

    /**
     * @see AreaType
     * @param DeskInterface $desk
     * @param int $type A constant of {@see AreaType}
     * @param int $coordinateX
     * @param int $coordinateY
     * @param ShipInterface $ship
     * @return \App\Component\Area\Interfaces\AreaInterface
     * @throws AreaException
     */
    protected function createArea
    (
        DeskInterface $desk,
        int $type,
        int $coordinateX,
        int $coordinateY,
        ShipInterface $ship = null
    ): AreaInterface {
        $area = $this->getAreaBuilder()->build($desk, $type, $coordinateX, $coordinateY);

        if ($ship !== null) {
            $area->setShip($ship);
        }

        $this->getAreaManager()->save($area);

        return $area;
    }
}
