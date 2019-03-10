<?php declare(strict_types=1);

namespace App\Entity;

use App\Constants\DeskType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeskRepository")
 */
class Desk
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
     * @ORM\OneToMany(targetEntity="App\Entity\Shoot", mappedBy="desk")
     */
    private $shoots;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ship", mappedBy="desk", orphanRemoval=true)
     */
    private $ships;

    /**
     * Desk constructor.
     */
    public function __construct()
    {
        $this->shoots = new ArrayCollection();
        $this->ships = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null A constant of {@see DeskType}
     * @see DeskType
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type A constant of {@see DeskType}
     * @see DeskType
     * @return Desk
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Game|null
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * @param Game|null $game
     * @return Desk
     */
    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection|Shoot[]
     */
    public function getShoots(): Collection
    {
        return $this->shoots;
    }

    /**
     * @param Shoot $shoot
     * @return Desk
     */
    public function addShoot(Shoot $shoot): self
    {
        if (!$this->shoots->contains($shoot)) {
            $this->shoots[] = $shoot;
            $shoot->setDesk($this);
        }

        return $this;
    }

    /**
     * @param Shoot $shoot
     * @return Desk
     */
    public function removeShoot(Shoot $shoot): self
    {
        if ($this->shoots->contains($shoot)) {
            $this->shoots->removeElement($shoot);
            // set the owning side to null (unless already changed)
            if ($shoot->getDesk() === $this) {
                $shoot->setDesk(null);
            }
        }

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
     * @param Ship $ship
     * @return Desk
     */
    public function addShip(Ship $ship): self
    {
        if (!$this->ships->contains($ship)) {
            $this->ships[] = $ship;
            $ship->setDesk($this);
        }

        return $this;
    }

    /**
     * @param Ship $ship
     * @return Desk
     */
    public function removeShip(Ship $ship): self
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
}
