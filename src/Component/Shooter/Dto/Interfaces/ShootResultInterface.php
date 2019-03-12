<?php declare(strict_types=1);

namespace App\Component\Shooter\Dto\Interfaces;

use App\Interfaces\AreaInterface;

/**
 * Interface ShootResultInterface
 * @package App\Component\Dto\Interfaces
 */
interface ShootResultInterface
{
    /**
     * @return AreaInterface
     */
    public function getArea(): AreaInterface;
}
