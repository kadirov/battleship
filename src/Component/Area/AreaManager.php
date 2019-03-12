<?php declare(strict_types=1);

namespace App\Component\Area;

use App\Component\Area\Interfaces\AreaManagerInterface;
use App\Entity\Area;
use Doctrine\ORM\EntityManagerInterface;

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
     * @param Area $area
     */
    public function save(Area $area): void
    {
        $this->em->persist($area);
        $this->em->flush();
    }
}
