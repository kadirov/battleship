<?php

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
     * @ORM\Column(type="integer")
     */
    private $deskId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Desk", inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $desk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoordinateX(): ?int
    {
        return $this->coordinateX;
    }

    public function setCoordinateX(int $coordinateX): self
    {
        $this->coordinateX = $coordinateX;

        return $this;
    }

    public function getCoordinateY(): ?int
    {
        return $this->coordinateY;
    }

    public function setCoordinateY(int $coordinateY): self
    {
        $this->coordinateY = $coordinateY;

        return $this;
    }

    public function getDeskId(): ?int
    {
        return $this->deskId;
    }

    public function setDeskId(int $deskId): self
    {
        $this->deskId = $deskId;

        return $this;
    }

    public function getDesk(): ?Desk
    {
        return $this->desk;
    }

    public function setDesk(?Desk $desk): self
    {
        $this->desk = $desk;

        return $this;
    }
}
