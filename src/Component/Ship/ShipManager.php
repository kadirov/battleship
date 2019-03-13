<?php declare(strict_types=1);

namespace App\Component\Ship;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Ship\Interfaces\ShipInterface;
use App\Component\Ship\Interfaces\ShipManagerInterface;
use Doctrine\ORM\EntityManager;

class ShipManager implements ShipManagerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ShipManager constructor.
     * @param EntityManager $em
     */
    public function __construct
    (
        EntityManager $em
    )
    {
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
        // TODO: Implement isSink() method.
    }

    /**
     * @param ShipInterface $ship
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(ShipInterface $ship): void
    {
        $this->em->persist($ship);
        $this->em->flush();
    }
}
