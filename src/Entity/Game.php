<?php declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\DeskInterface;
use App\Interfaces\GameInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game implements GameInterface
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
     * @return GameInterface
     */
    public function setToken(string $token): GameInterface
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
     * @param DeskInterface $desk
     * @return GameInterface
     */
    public function addDesk(DeskInterface $desk): GameInterface
    {
        if (!$this->desks->contains($desk)) {
            $this->desks[] = $desk;
            $desk->setGame($this);
        }

        return $this;
    }

    /**
     * @param DeskInterface $desk
     * @return GameInterface
     */
    public function removeDesk(DeskInterface $desk): GameInterface
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
