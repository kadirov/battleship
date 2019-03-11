<?php declare(strict_types=1);

namespace App\Component;

use App\Component\Interfaces\DeskBuilderInterface;
use App\Component\Interfaces\GameBuilderInterface;
use App\Entity\Game;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class GameBuilder
 * @package App\Component
 */
class GameBuilder implements GameBuilderInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var DeskBuilderInterface
     */
    private $deskBuilder;

    /**
     * GameBuilder constructor.
     * @param EntityManagerInterface $em
     * @param DeskBuilderInterface $deskBuilder
     */
    public function __construct
    (
        EntityManagerInterface $em,
        DeskBuilderInterface $deskBuilder
    ) {
        $this->em = $em;
        $this->deskBuilder = $deskBuilder;
    }

    /**
     * Game builder
     *
     * @return Game
     * @throws \Doctrine\ORM\ORMException
     */
    public function build(): Game
    {
        // todo via managers
        $game = new Game();
        $game->setToken($this->generateToken());

        $this->em->persist($game);
        $this->em->flush();

        $deskCpu = $this->deskBuilder->buildDeskCpu($game);
        $deskUser = $this->deskBuilder->buildDeskUser($game);

        $this->em->persist($deskCpu);
        $this->em->flush();

        $this->em->persist($deskUser);
        $this->em->flush();

        return $game;
    }

    /**
     * @return string
     */
    private function generateToken(): string
    {
        return \md5(\rand(1, 1000) . \uniqid());
    }
}
