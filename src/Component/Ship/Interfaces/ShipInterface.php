<?php declare(strict_types=1);

namespace App\Component\Ship\Interfaces;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Common\Interfaces\ModelInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Constants\ShipStatus;
use App\Component\Ship\Constants\ShipType;
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
     * @return Collection|\App\Component\Area\Interfaces\AreaInterface[]
     */
    public function getAreas(): Collection;

    /**
     * @param \App\Component\Area\Interfaces\AreaInterface $area
     * @return ShipInterface
     */
    public function addArea(AreaInterface $area): self;

    /**
     * @param \App\Component\Area\Interfaces\AreaInterface $area
     * @return ShipInterface
     */
    public function removeArea(AreaInterface $area): self;
}
