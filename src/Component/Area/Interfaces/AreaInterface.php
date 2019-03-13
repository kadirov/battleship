<?php declare(strict_types=1);

namespace App\Component\Area\Interfaces;

use App\Component\Area\Constants\AreaType;
use App\Component\Common\Interfaces\ModelInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Interfaces\ShipInterface;

interface AreaInterface extends ModelInterface
{
    /**
     * @return int A constant of {@see AreaType}
     * @see AreaType
     */
    public function getType(): int;

    /**
     * @param int $type A constant of {@see AreaType}
     * @see AreaType
     * @return AreaInterface
     */
    public function setType(int $type): self;

    /**
     * @return ShipInterface|null
     */
    public function getShip(): ?ShipInterface;

    /**
     * @param ShipInterface|null $ship
     * @return AreaInterface
     */
    public function setShip(?ShipInterface $ship): self;

    /**
     * @return int|null
     */
    public function getCoordinateX(): ?int;

    /**
     * @param int $coordinateX
     * @return AreaInterface
     */
    public function setCoordinateX(int $coordinateX): self;

    /**
     * @return int|null
     */
    public function getCoordinateY(): ?int;

    /**
     * @param int $coordinateY
     * @return AreaInterface
     */
    public function setCoordinateY(int $coordinateY): self;

    /**
     * @return DeskInterface|null
     */
    public function getDesk(): ?\App\Component\Desk\Interfaces\DeskInterface;

    /**
     * @param DeskInterface|null $desk
     * @return AreaInterface
     */
    public function setDesk(?\App\Component\Desk\Interfaces\DeskInterface $desk): self;
}
