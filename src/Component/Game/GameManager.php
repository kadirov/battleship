<?php declare(strict_types=1);

namespace App\Component\Game;

use App\Component\Game\Interfaces\GameInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class GameManager
 * @package App\Manager
 */
class GameManager implements GameManagerInterface
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
     * @param GameInterface $game
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(GameInterface $game): void
    {
        $this->em->persist($game);
        $this->em->flush();
    }
}
