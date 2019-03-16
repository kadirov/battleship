<?php declare(strict_types=1);

namespace App\Component\Game\Interfaces;

use App\Component\Common\Constants\UserType;
use App\Component\Common\Interfaces\ModelInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Interface GameInterface
 * @package App\Component\Game\Interfaces
 */
interface GameInterface extends ModelInterface
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

    /**
     * @return bool
     */
    public function getIsGameOver(): bool;

    /**
     * @param bool $isGameOver
     * @return GameInterface
     */
    public function setIsGameOver(bool $isGameOver): self;

    /**
     * @return int A constant of {@see UserType}
     */
    public function getTurn(): int;

    /**
     * @see UserType
     * @param int $turn A constant of {@see UserType}
     * @return GameInterface
     */
    public function setTurn(int $turn): self;
}
