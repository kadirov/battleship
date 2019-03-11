<?php declare(strict_types=1);

namespace App\Entity;

use App\Constants\AreaType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AreaRepository")
 */
class Area
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
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getShip(): ?Ship
    {
        return $this->ship;
    }

    public function setShip(?Ship $ship): self
    {
        $this->ship = $ship;

        return $this;
    }
}
