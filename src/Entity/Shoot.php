<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShootRepository")
 */
class Shoot
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
    private $coordinateX;

    /**
     * @ORM\Column(type="smallint")
     */
    private $coordinateY;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Desk", inversedBy="shoots")
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
     * @return int|null
     */
    public function getCoordinateX(): ?int
    {
        return $this->coordinateX;
    }

    /**
     * @param int $coordinateX
     * @return Shoot
     */
    public function setCoordinateX(int $coordinateX): self
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
     * @return Shoot
     */
    public function setCoordinateY(int $coordinateY): self
    {
        $this->coordinateY = $coordinateY;

        return $this;
    }

    /**
     * @return Desk|null
     */
    public function getDesk(): ?Desk
    {
        return $this->desk;
    }

    /**
     * @param Desk|null $desk
     * @return Shoot
     */
    public function setDesk(?Desk $desk): self
    {
        $this->desk = $desk;

        return $this;
    }
}
