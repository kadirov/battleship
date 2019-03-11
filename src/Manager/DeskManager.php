<?php declare(strict_types=1);

namespace App\Manager;

use App\Entity\Desk;
use Doctrine\ORM\EntityManager;

/**
 * Class DeskManager
 * @package App\Manager
 */
class DeskManager
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
     * @param Desk $desk
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Desk $desk): void
    {
        $this->em->persist($desk);
        $this->em->flush();
    }
}
