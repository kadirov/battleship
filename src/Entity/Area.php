<?php declare(strict_types=1);

namespace App\Entity;

use App\Component\Ship\Interfaces\ShipInterface;
use App\Constants\AreaType;
use App\Interfaces\AreaInterface;
use App\Interfaces\DeskInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AreaRepository")
 */
class Area implements AreaInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ship", inversedBy="area")
     */
    private $ship;

    /**
     * @ORM\Column(type="smallint")
     */
    private $coordinateX;

    /**
     * @ORM\Column(type="smallint")
     */
    private $coordinateY;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Desk", inversedBy="areas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $desk;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int A constant of {@see AreaType}
     * @see AreaType
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type A constant of {@see AreaType}
     * @see AreaType
     * @return Area
     */
    public function setType(int $type): AreaInterface
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Ship|null
     */
    public function getShip(): ?ShipInterface
    {
        return $this->ship;
    }

    /**
     * @param \App\Component\Ship\Interfaces\ShipInterface|null $ship
     * @return Area
     */
    public function setShip(?ShipInterface $ship): AreaInterface
    {
        $this->ship = $ship;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCoordinateX(): ?int
    {
        return $this->coordinateX;
    }

    /**
     * @param int $coordinateX
     * @return Area
     */
    public function setCoordinateX(int $coordinateX): AreaInterface
    {
        $this->coordinateX = $coordinateX;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCoordinateY(): ?int
    {
        return $this->coordinateY;
    }

    /**
     * @param int $coordinateY
     * @return Area
     */
    public function setCoordinateY(int $coordinateY): AreaInterface
    {
        $this->coordinateY = $coordinateY;

        return $this;
    }

    /**
     * @return Desk|null
     */
    public function getDesk(): ?DeskInterface
    {
        return $this->desk;
    }

    /**
     * @param DeskInterface|null $desk
     * @return Area
     */
    public function setDesk(?DeskInterface $desk): AreaInterface
    {
        $this->desk = $desk;

        return $this;
    }
}
