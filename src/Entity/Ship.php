<?php declare(strict_types=1);

namespace App\Entity;

use App\Component\Ship\Interfaces\ShipInterface;
use App\Constants\ShipStatus;
use App\Constants\ShipType;
use App\Interfaces\AreaInterface;
use App\Interfaces\DeskInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipRepository")
 */
class Ship implements ShipInterface
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
     * @return DeskInterface|null
     */
    public function getDesk(): ?DeskInterface
    {
        return $this->desk;
    }

    /**
     * @param DeskInterface|null $desk
     * @return \App\Component\Ship\Interfaces\ShipInterface
     */
    public function setDesk(?DeskInterface $desk): ShipInterface
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
     * @return ShipInterface
     */
    public function setStatus(int $status): ShipInterface
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
     * @return ShipInterface
     */
    public function setType(int $type): ShipInterface
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|AreaInterface[]
     */
    public function getAreas(): Collection
    {
        return $this->area;
    }

    /**
     * @param AreaInterface $area
     * @return ShipInterface
     */
    public function addArea(AreaInterface $area): ShipInterface
    {
        if (!$this->area->contains($area)) {
            $this->area[] = $area;
            $area->setShip($this);
        }

        return $this;
    }

    /**
     * @param AreaInterface $area
     * @return ShipInterface
     */
    public function removeArea(AreaInterface $area): ShipInterface
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
