<?php declare(strict_types=1);

namespace App\Component\Desk;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class DeskManager
 * @package App\Manager
 */
class DeskManager implements DeskManagerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * DeskManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param DeskInterface $desk
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
}
