<?php declare(strict_types=1);

namespace App\Component\Ship;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Interfaces\ShipInterface;
use App\Component\Ship\Interfaces\ShipManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ShipManager
 * @package App\Component\Ship
 */
class ShipManager implements ShipManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ShipManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct
    (
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    /**
     * Returns true if all parts of ship are HIT
     *
     * @see AreaInterface
     * @param ShipInterface $ship
     * @return bool
     */
    public function isSink(ShipInterface $ship): bool
    {
        foreach ($ship->getAreas() as $area) {
            if ($area->getType() === AreaType::HIT) {
                continue;
            }

            if ($area->getType() === AreaType::SINK) {
                continue;
            }

            return false;
        }

        return true;
    }

    /**
     * @param ShipInterface $ship
     */
    public function save(ShipInterface $ship): void
    {
        $this->em->persist($ship);
        $this->em->flush();
    }

    /**
     * @param DeskInterface $desk
     * @return bool
     */
    public function isAllShipsSink(DeskInterface $desk): bool
    {
        foreach ($desk->getShips() as $ship) {
            if (!$this->isSink($ship)) {
                return false;
            }
        }

        return true;
    }
}
