<?php declare(strict_types=1);

namespace App\Component\Game;

use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskBuilderInterface;
use App\Component\Game\Interfaces\GameBuilderInterface;
use App\Component\Game\Interfaces\GameInterface;
use App\Component\Game\Interfaces\GameManagerInterface;
use App\Entity\Game;

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
     * GameBuilder constructor.
     * @param GameManagerInterface $gameManager
     * @param DeskBuilderInterface $deskBuilder
     */
    public function __construct
    (
        GameManagerInterface $gameManager,
        DeskBuilderInterface $deskBuilder
    ) {
        $this->deskBuilder = $deskBuilder;
        $this->gameManager = $gameManager;
    }

    /**
     * Game builder
     * @return GameInterface
     */
    public function build(): GameInterface
    {
        $game = new Game();
        $game->setTurn(UserType::USER);
        $game->setIsGameOver(false);
        $game->setToken($this->generateToken());

        $this->gameManager->save($game);

        $this->deskBuilder->buildDeskCpu($game);
        $this->deskBuilder->buildDeskUser($game);

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
