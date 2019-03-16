<?php declare(strict_types=1);

namespace App\Component\Desk;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Game\Interfaces\GameInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DeskManager
 * @package App\Manager
 */
class DeskManager implements DeskManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * DeskManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param DeskInterface $desk
     */
    public function save(DeskInterface $desk): void
    {
        $this->em->persist($desk);
        $this->em->flush();
    }

    /**
     * @param DeskInterface $desk
     * @param int $coordinateX
     * @param int $coordinateY
     * @return AreaInterface|null
     */
    public function getAreaByCoordinates(DeskInterface $desk, int $coordinateX, int $coordinateY): ?AreaInterface
    {
        foreach ($desk->getAreas() as $area) {
            if ($area->getCoordinateX() === $coordinateX && $area->getCoordinateY() === $coordinateY) {
                return $area;
            }
        }

        return null;
    }

    /**
     * Get game->desktop by {@see UserType}
     *
     * @see UserType
     * @param GameInterface $game
     * @param int $userType A constant of {@see UserType}
     * @return DeskInterface|null
     */
    public function getByType(GameInterface $game, int $userType): ?DeskInterface
    {
        foreach ($game->getDesks() as $desk) {
            if ($desk->getType() === $userType) {
                return $desk;
            }
        }

        return null;
    }
}
