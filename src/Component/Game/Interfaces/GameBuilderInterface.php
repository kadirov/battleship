<?php declare(strict_types=1);

namespace App\Component\Game\Interfaces;

use App\Entity\Game;
use App\Interfaces\GameInterface;

/**
 * Interface GameFactoryInterface
 * @package App\Interfaces
 */
interface GameBuilderInterface
{
    /**
     * Game builder
     *
     * @return GameInterface
     */
    public function build(): GameInterface;
}
