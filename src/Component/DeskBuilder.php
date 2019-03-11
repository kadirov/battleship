<?php declare(strict_types=1);

namespace App\Component;

use App\Component\Interfaces\DeskBuilderInterface;
use App\Constants\DeskType;
use App\Entity\Desk;
use App\Entity\Game;

/**
 * Class DeskBuilder
 * @package App\Component
 */
class DeskBuilder implements DeskBuilderInterface
{
    /**
     * @param Game $game
     * @return Desk
     */
    public function buildDeskCpu(Game $game): Desk
    {
        return $this->build($game, DeskType::CPU);
    }

    /**
     * @param Game $game
     * @return Desk
     */
    public function buildDeskUser(Game $game): Desk
    {
        return $this->build($game, DeskType::USER);
    }

    /**
     * @param Game $game
     * @param int $type A constant of {@see DeskType}
     * @see DeskType
     * @return Desk
     */
    private function build(Game $game, int $type): Desk
    {
        $desk = new Desk();
        $desk->setGame($game);
        $desk->setType($type);

        return $desk;
    }
}
