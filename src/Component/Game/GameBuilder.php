<?php declare(strict_types=1);

namespace App\Component\Game;

use App\Component\Desk\Interfaces\DeskBuilderInterface;
use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Game\Interfaces\GameBuilderInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use App\Entity\Game;
use App\Interfaces\GameInterface;

/**
 * Class GameBuilder
 * @package App\Component
 */
class GameBuilder implements GameBuilderInterface
{
    /**
     * @var \App\Component\Desk\Interfaces\DeskBuilderInterface
     */
    private $deskBuilder;

    /**
     * @var GameManagerInterface
     */
    private $gameManager;
    /**
     * @var DeskManagerInterface
     */
    private $deskManager;

    /**
     * GameBuilder constructor.
     * @param GameManagerInterface $gameManager
     * @param DeskBuilderInterface $deskBuilder
     * @param DeskManagerInterface $deskManager
     */
    public function __construct
    (
        GameManagerInterface $gameManager,
        DeskBuilderInterface $deskBuilder,
        DeskManagerInterface $deskManager
    ) {
        $this->deskBuilder = $deskBuilder;
        $this->gameManager = $gameManager;
        $this->deskManager = $deskManager;
    }

    /**
     * Game builder
     * @return GameInterface
     */
    public function build(): GameInterface
    {
        $game = new Game();
        $game->setToken($this->generateToken());

        $this->gameManager->save($game);

        $deskCpu = $this->deskBuilder->buildDeskCpu($game);
        $deskUser = $this->deskBuilder->buildDeskUser($game);

        $this->deskManager->save($deskCpu);
        $this->deskManager->save($deskUser);

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
