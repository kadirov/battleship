<?php declare(strict_types=1);

namespace App\Component\Desk;

use App\Component\Desk\Interfaces\DeskBuilderInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Game\Interfaces\GameInterface;
use App\Component\Ship\Constants\DeskType;
use App\Component\Ship\Constants\ShipType;
use App\Component\Ship\Interfaces\ShipFactoryInterface;
use App\Entity\Desk;

/**
 * Class DeskBuilder
 * @package App\Component
 */
class DeskBuilder implements DeskBuilderInterface
{
    /**
     * @var ShipFactoryInterface
     */
    private $shipFactory;

    /**
     * DeskBuilder constructor.
     * @param ShipFactoryInterface $shipFactory
     */
    public function __construct
    (
        ShipFactoryInterface $shipFactory
    )
    {
        $this->shipFactory = $shipFactory;
    }

    /**
     * @param GameInterface $game
     * @return \App\Component\Desk\Interfaces\DeskInterface
     */
    public function buildDeskCpu(GameInterface $game): DeskInterface
    {
        return $this->build($game, DeskType::CPU);
    }

    /**
     * @param GameInterface $game
     * @return DeskInterface
     */
    public function buildDeskUser(GameInterface $game): DeskInterface
    {
        return $this->build($game, DeskType::USER);
    }

    /**
     * @param GameInterface $game
     * @param int $type A constant of {@see DeskType}
     * @see DeskType
     * @return DeskInterface
     */
    private function build(GameInterface $game, int $type): DeskInterface
    {
        $desk = new Desk();
        $desk->setGame($game);
        $desk->setType($type);
        $this->generateShips($desk);

        return $desk;
    }

    /**
     * @param DeskInterface $desk
     */
    private function generateShips(DeskInterface $desk): void
    {
        $this->shipFactory->build($desk, ShipType::L_SHAPED);
        $this->shipFactory->build($desk, ShipType::I_SHAPED);
        $this->shipFactory->build($desk, ShipType::DOT_SHAPED);
        $this->shipFactory->build($desk, ShipType::DOT_SHAPED);
    }
}
