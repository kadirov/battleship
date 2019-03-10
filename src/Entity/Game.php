<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $token;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Desk", mappedBy="game", orphanRemoval=true)
     */
    private $desks;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->desks = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Game
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection|Desk[]
     */
    public function getDesks(): Collection
    {
        return $this->desks;
    }

    /**
     * @param Desk $desk
     * @return Game
     */
    public function addDesk(Desk $desk): self
    {
        if (!$this->desks->contains($desk)) {
            $this->desks[] = $desk;
            $desk->setGame($this);
        }

        return $this;
    }

    /**
     * @param Desk $desk
     * @return Game
     */
    public function removeDesk(Desk $desk): self
    {
        if ($this->desks->contains($desk)) {
            $this->desks->removeElement($desk);
            // set the owning side to null (unless already changed)
            if ($desk->getGame() === $this) {
                $desk->setGame(null);
            }
        }

        return $this;
    }
}
