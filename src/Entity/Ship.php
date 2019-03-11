<?php declare(strict_types=1);

namespace App\Entity;

use App\Constants\ShipStatus;
use App\Constants\ShipType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipRepository")
 */
class Ship
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Desk", inversedBy="ships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $desk;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Area", mappedBy="ship")
     */
    private $area;

    public function __construct()
    {
        $this->area = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Ship
     */
    public function setDesk(?Desk $desk): self
    {
        $this->desk = $desk;

        return $this;
    }

    /**
     * @see ShipStatus
     * @return int|null A constant of {@see ShipStatus}
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @see ShipStatus
     * @param int $status A constant of {@see ShipStatus}
     * @return Ship
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null A constant of {@see ShipType}
     * @see ShipType
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type A constant of {@see ShipType}
     * @see ShipType
     * @return Ship
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Area[]
     */
    public function getArea(): Collection
    {
        return $this->area;
    }

    public function addArea(Area $area): self
    {
        if (!$this->area->contains($area)) {
            $this->area[] = $area;
            $area->setShip($this);
        }

        return $this;
    }

    public function removeArea(Area $area): self
    {
        if ($this->area->contains($area)) {
            $this->area->removeElement($area);
            // set the owning side to null (unless already changed)
            if ($area->getShip() === $this) {
                $area->setShip(null);
            }
        }

        return $this;
    }
}
