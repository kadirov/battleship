<?php declare(strict_types=1);

namespace App\Component\Game;

use App\Component\Game\Interfaces\GameInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;

/**
 * Class GameManager
 * @package App\Manager
 */
class GameManager implements GameManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * GameManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param GameInterface $game
     */
    public function save(GameInterface $game): void
    {
        $this->em->persist($game);
        $this->em->flush();
    }

    /**
     * @param string $token
     * @return GameInterface|null
     */
    public function getByToken(string $token): ?GameInterface
    {
        $games = $this->em->getRepository(Game::class)->findBy(['token' => $token]);

        return $games[0] ?? null;
    }
}
