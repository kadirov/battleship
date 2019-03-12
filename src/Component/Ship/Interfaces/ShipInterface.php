<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Interfaces\AreaInterface;
use App\Interfaces\DeskInterface;
use App\Interfaces\ModelInterface;
use Doctrine\Common\Collections\Collection;

interface ShipInterface extends ModelInterface
{
    /**
     * @return DeskInterface|null
     */
    public function getDesk(): ?DeskInterface;

    /**
     * @param DeskInterface|null $desk
     * @return ShipInterface
     */
    public function setDesk(?DeskInterface $desk): self;

    /**
     * @see ShipStatus
     * @return int|null A constant of {@see ShipStatus}
     */
    public function getStatus(): ?int;

    /**
     * @see ShipStatus
     * @param int $status A constant of {@see ShipStatus}
     * @return ShipInterface
     */
    public function setStatus(int $status): self;

    /**
     * @return int|null A constant of {@see ShipType}
     * @see ShipType
     */
    public function getType(): ?int;

    /**
     * @param int $type A constant of {@see ShipType}
     * @see ShipType
     * @return ShipInterface
     */
    public function setType(int $type): self;

    /**
     * @return Collection|AreaInterface[]
     */
    public function getAreas(): Collection;

    /**
     * @param AreaInterface $area
     * @return ShipInterface
     */
    public function addArea(AreaInterface $area): self;

    /**
     * @param AreaInterface $area
     * @return ShipInterface
     */
    public function removeArea(AreaInterface $area): self;
}
