<?php declare(strict_types=1);

namespace App\Component\Game\Interfaces;

interface GameManagerInterface
{
    /**
     * @param GameInterface $game
     */
    public function save(GameInterface $game): void;
}
