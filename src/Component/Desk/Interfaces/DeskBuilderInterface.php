<?php

namespace App\Component\Desk\Interfaces;


use App\Component\Game\Interfaces\GameInterface;

/**
 * Interface DeskBuilderInterface
 * @package App\Interfaces
 */
interface DeskBuilderInterface
{
    /**
     * @param GameInterface $game
     * @return DeskInterface
     */
    public function buildDeskCpu(GameInterface $game): DeskInterface;

    /**
     * @param GameInterface $game
     * @return DeskInterface
     */
    public function buildDeskUser(GameInterface $game): DeskInterface;
}
