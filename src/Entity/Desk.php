<?php declare(strict_types=1);

namespace App\Entity;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Common\Constants\UserType;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Game\Interfaces\GameInterface;
use App\Component\Ship\Interfaces\ShipInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeskRepository")
 */
class Desk implements DeskInterface
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="desks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ship", mappedBy="desk", orphanRemoval=true)
     */
    private $ships;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Area", mappedBy="desk", orphanRemoval=true)
     */
    private $areas;

    /**
     * Desk constructor.
     */
    public function __construct()
    {
        $this->ships = new ArrayCollection();
        $this->areas = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null A constant of {@see UserType}
     * @see UserType
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type A constant of {@see UserType}
     * @see UserType
     * @return DeskInterface
     */
    public function setType(int $type): DeskInterface
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return GameInterface|null
     */
    public function getGame(): ?GameInterface
    {
        return $this->game;
    }

    /**
     * @param GameInterface|null $game
     * @return DeskInterface
     */
    public function setGame(?GameInterface $game): DeskInterface
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection|Ship[]
     */
    public function getShips(): Collection
    {
        return $this->ships;
    }

    /**
     * @param ShipInterface $ship
     * @return DeskInterface
     */
    public function addShip(ShipInterface $ship): DeskInterface
    {
        if (!$this->ships->contains($ship)) {
            $this->ships[] = $ship;
            $ship->setDesk($this);
        }

        return $this;
    }

    /**
     * @param ShipInterface $ship
     * @return DeskInterface
     */
    public function removeShip(ShipInterface $ship): DeskInterface
    {
        if ($this->ships->contains($ship)) {
            $this->ships->removeElement($ship);
            // set the owning side to null (unless already changed)
            if ($ship->getDesk() === $this) {
                $ship->setDesk(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Area[]
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    /**
     * @param AreaInterface $area
     * @return DeskInterface
     */
    public function addArea(AreaInterface $area): DeskInterface
    {
        if (!$this->areas->contains($area)) {
            $this->areas[] = $area;
            $area->setDesk($this);
        }

        return $this;
    }

    /**
     * @param AreaInterface $area
     * @return DeskInterface
     */
    public function removeArea(AreaInterface $area): DeskInterface
    {
        if ($this->areas->contains($area)) {
            $this->areas->removeElement($area);
            // set the owning side to null (unless already changed)
            if ($area->getDesk() === $this) {
                $area->setDesk(null);
            }
        }

        return $this;
    }
}
