<?php declare(strict_types=1);

namespace App\Component\Game\Interfaces;

use App\Component\Desk\Interfaces\DeskInterface;
use Doctrine\Common\Collections\Collection;

interface GameInterface extends \App\Component\Common\Interfaces\ModelInterface
{
    /**
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * @param string $token
     * @return GameInterface
     */
    public function setToken(string $token): self;

    /**
     * @return Collection|DeskInterface[]
     */
    public function getDesks(): Collection;

    /**
     * @param DeskInterface $desk
     * @return GameInterface
     */
    public function addDesk(DeskInterface $desk): self;

    /**
     * @param DeskInterface $desk
     * @return GameInterface
     */
    public function removeDesk(DeskInterface $desk): self;
}
