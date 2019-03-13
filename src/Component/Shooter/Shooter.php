<?php declare(strict_types=1);

namespace App\Component\Shooter;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Area\Interfaces\AreaManagerInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Interfaces\ShipManagerInterface;
use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;
use App\Component\Shooter\Dto\ShootResult;
use App\Component\Shooter\Interfaces\ShooterInterface;
use App\Entity\Area;

/**
 * Class Shooter
 * @package App\Component
 */
class Shooter implements ShooterInterface
{
    /**
     * @var AreaManagerInterface
     */
    private $areaManager;

    /**
     * @var ShipManagerInterface
     */
    private $shipManager;

    /**
     * Shooter constructor.
     * @param AreaManagerInterface $areaManager
     * @param ShipManagerInterface $shipManager
     */
    public function __construct
    (
        AreaManagerInterface $areaManager,
        ShipManagerInterface $shipManager
    ) {
        $this->areaManager = $areaManager;
        $this->shipManager = $shipManager;
    }

    /**
     * @param \App\Component\Desk\Interfaces\DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return ShootResultInterface
     */
    public function shoot(DeskInterface $desk, int $coordinateX, int $coordinateY): ShootResultInterface
    {
        $currentArea = null;

        foreach ($desk->getAreas() as $area) {
            if ($area->getCoordinateX() === $coordinateX && $area->getCoordinateY() === $coordinateY) {
                $currentArea = $area;
            }
        }

        if ($currentArea === null) {
            $currentArea = new Area();
            $currentArea->setType(AreaType::SEA);
            $currentArea->setCoordinateX($coordinateX);
            $currentArea->setCoordinateY($coordinateY);
        }

        switch ($currentArea->getType()) {
            case AreaType::SEA:
                $currentArea->setType(AreaType::MISS);
                $this->areaManager->save($currentArea);
                break;

            case AreaType::INTACT:
                $currentArea->setType(AreaType::HIT);
                $this->areaManager->save($currentArea);

                $this->sinkShipIfNeed($currentArea);
                break;

            case AreaType::SINK:
            case AreaType::HIT:
            case AreaType::MISS:
                // nothing to do if user re-shoots to same area that he shot before
                break;

            default:
                throw new \LogicException('Area::$type must be a constant of AreaType');
        }

        return new ShootResult($currentArea);
    }

    /**
     * If all parts of ship are HIT change ship area types to SINK
     *
     * @param AreaInterface $area
     */
    private function sinkShipIfNeed(AreaInterface $area): void
    {
        $ship = $area->getShip();

        if ($ship === null) {
            throw new \LogicException('Here must be related ship!');
        }

        if (!$this->shipManager->isSink($ship)) {
            return;
        }

        foreach ($ship->getAreas() as $shipPartArea) {
            $shipPartArea->setType(AreaType::SINK);
            $this->areaManager->save($shipPartArea);
        }
    }
}
