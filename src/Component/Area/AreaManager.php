<?php declare(strict_types=1);

namespace App\Component\Area;

use App\Component\Area\Exceptions\AreaException;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Area\Interfaces\AreaManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AreaManager
 * @package App\Component\Area
 */
class AreaManager implements AreaManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AreaManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct
    (
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    /**
     * @param AreaInterface $area
     * @throws AreaException Method throws this exception if area has wrong coordinates
     */
    public function save(AreaInterface $area): void
    {
        if (!$this->isValidCoordinates($area->getCoordinateX(), $area->getCoordinateY())) {
            throw new AreaException('Wrong coordinates for area');
        }

        $this->em->persist($area);
        $this->em->flush();
    }

    /**
     * @param int $coordinateX
     * @param int $coordinateY
     * @return bool
     */
    public function isValidCoordinates(int $coordinateX, int $coordinateY): bool
    {
        if ($coordinateX < 1 || $coordinateX > 10) {
            return false;
        }

        if ($coordinateY < 1 || $coordinateY > 10) {
            return false;
        }

        return true;
    }
}
