<?php declare(strict_types=1);

namespace App\Component\Game\Interfaces;

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
