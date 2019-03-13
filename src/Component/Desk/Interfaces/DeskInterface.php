<?php declare(strict_types=1);

namespace App\Component\Desk\Interfaces;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Common\Interfaces\ModelInterface;
use App\Component\Game\Interfaces\GameInterface;
use App\Component\Ship\Constants\DeskType;
use App\Component\Ship\Interfaces\ShipInterface;
use Doctrine\Common\Collections\Collection;

interface DeskInterface extends ModelInterface
{
    /**
     * @return int|null A constant of {@see DeskType}
     * @see DeskType
     */
    public function getType(): ?int;

    /**
     * @param int $type A constant of {@see DeskType}
     * @see DeskType
     * @return DeskInterface
     */
    public function setType(int $type): self;

    /**
     * @return GameInterface|null
     */
    public function getGame(): ?GameInterface;

    /**
     * @param GameInterface|null $game
     * @return DeskInterface
     */
    public function setGame(?GameInterface $game): self;

    /**
     * @return Collection|ShipInterface []
     */
    public function getShips(): Collection;

    /**
     * @param ShipInterface $ship
     * @return DeskInterface
     */
    public function addShip(ShipInterface $ship): self;

    /**
     * @param ShipInterface $ship
     * @return DeskInterface
     */
    public function removeShip(ShipInterface $ship): self;

    /**
     * @return Collection|AreaInterface[]
     */
    public function getAreas(): Collection;

    /**
     * @param AreaInterface $area
     * @return DeskInterface
     */
    public function addArea(AreaInterface $area): self;

    /**
     * @param AreaInterface $area
     * @return DeskInterface
     */
    public function removeArea(AreaInterface $area): self;
}
