<?php declare(strict_types=1);

namespace App\Component\Shooter;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Exceptions\AreaException;
use App\Component\Area\Interfaces\AreaBuilderInterface;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Area\Interfaces\AreaManagerInterface;
use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use App\Component\Ship\Interfaces\ShipManagerInterface;
use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;
use App\Component\Shooter\Dto\ShootResult;
use App\Component\Shooter\Interfaces\ShooterInterface;

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
     * @var GameManagerInterface
     */
    private $gameManager;

    /**
     * @var AreaBuilderInterface
     */
    private $areaBuilder;

    /**
     * @var array
     */
    private $userCoordinates;

    /**
     * @var DeskManagerInterface
     */
    private $deskManager;

    /**
     * Shooter constructor.
     * @param AreaManagerInterface $areaManager
     * @param ShipManagerInterface $shipManager
     * @param GameManagerInterface $gameManager
     * @param AreaBuilderInterface $areaBuilder
     * @param DeskManagerInterface $deskManager
     */
    public function __construct
    (
        AreaManagerInterface $areaManager,
        ShipManagerInterface $shipManager,
        GameManagerInterface $gameManager,
        AreaBuilderInterface $areaBuilder,
        DeskManagerInterface $deskManager
    ) {
        $this->areaManager = $areaManager;
        $this->shipManager = $shipManager;
        $this->gameManager = $gameManager;
        $this->areaBuilder = $areaBuilder;
        $this->deskManager = $deskManager;
    }

    /**
     * @param DeskInterface $desk
     * @return ShootResultInterface
     * @throws AreaException
     */
    public function shootToUser(DeskInterface $desk): ShootResultInterface
    {
        $this->fillUserCoordinates();
        $this->deleteCpuShotAreas($desk);

        if ($desk->getType() === UserType::CPU) {
            throw new \LogicException('The desk->type must be equal to UserType::USER');
        }

        $coordinateX = $this->getUnshootX();
        $coordinateY = $this->getUnshootY($coordinateX);

        $shootResult = $this->shoot($desk, $coordinateX, $coordinateY);
        $this->unsetCoordinate($coordinateX, $coordinateY);

        return $shootResult;
    }

    /**
     * @param DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return ShootResultInterface
     * @throws AreaException
     */
    public function shootToCpu(DeskInterface $desk, int $coordinateX, int $coordinateY): ShootResultInterface
    {
        if ($desk->getType() === UserType::USER) {
            throw new \LogicException('The desk->type must be equal to UserType::CPU');
        }

        return $this->shoot($desk, $coordinateX, $coordinateY);
    }

    /**
     * @param DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return ShootResultInterface
     * @throws AreaException
     */
    private function shoot(DeskInterface $desk, int $coordinateX, int $coordinateY): ShootResultInterface
    {
        $currentArea = $this->deskManager->getAreaByCoordinates($desk, $coordinateX, $coordinateY);

        if ($currentArea === null) {
            $currentArea = $this->areaBuilder->build($desk, AreaType::SEA, $coordinateX, $coordinateY);
        }

        $this->checkArea($currentArea);
        $this->changeGameTurn($desk);

        if ($this->shipManager->isAllShipsSink($desk)) {
            $desk->getGame()->setIsGameOver(true);
        }

        if ($desk->getGame() === null) {
            throw new \LogicException('Desk must have a game');
        }

        $this->gameManager->save($desk->getGame());

        return new ShootResult($currentArea);
    }

    /**
     * @return int
     */
    private function getUnshootX(): int
    {
        return array_rand($this->userCoordinates);
    }

    /**
     * @param int $coordinateX
     * @return int
     */
    private function getUnshootY(int $coordinateX): int
    {
        return array_rand($this->userCoordinates[$coordinateX]);
    }

    /**
     * @param int $coordinateX
     * @param int $coordinateY
     */
    private function unsetCoordinate(int $coordinateX, int $coordinateY): void
    {
        unset($this->userCoordinates[$coordinateX][$coordinateY]);

        if (empty($this->userCoordinates[$coordinateX])) {
            unset($this->userCoordinates[$coordinateX]);
        }
    }

    /**
     * If all parts of ship are HIT change ship area types to SINK
     *
     * @param AreaInterface $area
     * @throws AreaException
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

    /**
     * @param DeskInterface $desk
     */
    private function changeGameTurn(DeskInterface $desk): void
    {
        if ($desk->getType() === UserType::USER) {
            $desk->getGame()->setTurn(UserType::USER);
        } else {
            $desk->getGame()->setTurn(UserType::CPU);
        }
    }

    /**
     * Fill user coordinates
     */
    private function fillUserCoordinates(): void
    {
        $coordinatesY = array_fill(1, 10, 1);
        $this->userCoordinates = array_fill(1, 10, $coordinatesY);
    }

    /**
     * @param DeskInterface $desk
     */
    private function deleteCpuShotAreas(DeskInterface $desk): void
    {
        foreach ($desk->getAreas() as $area) {
            switch ($area->getType()) {
                case AreaType::SINK:
                case AreaType::HIT:
                case AreaType::MISS:
                    $this->unsetCoordinate($area->getCoordinateX(), $area->getCoordinateY());
                    break;
            }
        }
    }

    /**
     * @param AreaInterface $currentArea
     * @throws AreaException
     */
    private function checkArea(AreaInterface $currentArea): void
    {
        switch ($currentArea->getType()) {
            case AreaType::SEA:
            case AreaType::SHIP_MARGIN:
                $currentArea->setType(AreaType::MISS);
                $this->areaManager->save($currentArea);
                break;

            case AreaType::INTACT:
                $currentArea->setType(AreaType::HIT);
                $this->areaManager->save($currentArea);

                $this->sinkShipIfNeed($currentArea);
                break;
        }
    }
}
