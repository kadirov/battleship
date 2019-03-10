<?php declare(strict_types=1);

namespace App\Interfaces;

use App\Entity\Game;

/**
 * Interface GameFactoryInterface
 * @package App\Interfaces
 */
interface GameBuilderInterface
{
    /**
     * Game builder
     *
     * @return Game
     */
    public function build(): Game;
}
