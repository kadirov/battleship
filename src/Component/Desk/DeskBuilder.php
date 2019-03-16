<?php declare(strict_types=1);

namespace App\Component\Desk;

use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskBuilderInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Game\Interfaces\GameInterface;
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
     * @var DeskManagerInterface
     */
    private $deskManager;

    /**
     * DeskBuilder constructor.
     * @param ShipFactoryInterface $shipFactory
     * @param DeskManagerInterface $deskManager
     */
    public function __construct
    (
        ShipFactoryInterface $shipFactory,
        DeskManagerInterface $deskManager
    ) {
        $this->shipFactory = $shipFactory;
        $this->deskManager = $deskManager;
    }

    /**
     * @param GameInterface $game
     * @return \App\Component\Desk\Interfaces\DeskInterface
     */
    public function buildDeskCpu(GameInterface $game): DeskInterface
    {
        return $this->build($game, UserType::CPU);
    }

    /**
     * @param GameInterface $game
     * @return DeskInterface
     */
    public function buildDeskUser(GameInterface $game): DeskInterface
    {
        return $this->build($game, UserType::USER);
    }

    /**
     * @param GameInterface $game
     * @param int $type A constant of {@see DeskType}
     * @see \App\Component\Common\Constants\UserType
     * @return DeskInterface
     */
    private function build(GameInterface $game, int $type): DeskInterface
    {
        $desk = new Desk();
        $game->addDesk($desk);
        $desk->setType($type);
        $this->generateShips($desk);
        $this->deskManager->save($desk);

        return $desk;
    }

    /**
     * @param DeskInterface $desk
     */
    private function generateShips(DeskInterface $desk): void
    {
        $lShaped = [ShipType::L_SHAPED, ShipType::L180_SHAPED, ShipType::L90_SHAPED, ShipType::L270_SHAPED];
        $this->shipFactory->build($desk, $lShaped[array_rand($lShaped)]);

        $iShaped = [ShipType::I_SHAPED, ShipType::I90_SHAPED];
        $this->shipFactory->build($desk, $iShaped[array_rand($iShaped)]);

        $this->shipFactory->build($desk, ShipType::DOT_SHAPED);

        $this->shipFactory->build($desk, ShipType::DOT_SHAPED);
    }
}
