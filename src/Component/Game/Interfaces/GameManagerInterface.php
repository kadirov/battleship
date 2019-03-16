<?php declare(strict_types=1);

namespace App\Component\Game\Interfaces;

/**
 * Interface GameManagerInterface
 * @package App\Component\Game\Interfaces
 */
interface GameManagerInterface
{
    /**
     * @param GameInterface $game
     */
    public function save(GameInterface $game): void;

    /**
     * @param string $token
     * @return GameInterface|null
     */
    public function getByToken(string $token): ?GameInterface;
}
