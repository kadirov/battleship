<?php declare(strict_types=1);

namespace App\Manager;

use App\Entity\Game;
use Doctrine\ORM\EntityManager;

/**
 * Class GameManager
 * @package App\Manager
 */
class GameManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * GameManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Game $game
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Game $game): void
    {
        $this->em->persist($game);
        $this->em->flush();
    }
}
