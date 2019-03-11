<?php

namespace App\Component\Interfaces;

use App\Entity\Desk;
use App\Entity\Game;

/**
 * Interface DeskBuilderInterface
 * @package App\Interfaces
 */
interface DeskBuilderInterface
{
    /**
     * @param Game $game
     * @return Desk
     */
    public function buildDeskCpu(Game $game): Desk;

    /**
     * @param Game $game
     * @return Desk
     */
    public function buildDeskUser(Game $game): Desk;
}
