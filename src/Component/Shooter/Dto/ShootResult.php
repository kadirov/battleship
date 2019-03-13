<?php declare(strict_types=1);

namespace App\Component\Shooter\Dto;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;
use App\Entity\Area;

class ShootResult implements ShootResultInterface
{
    /**
     * @var Area
     */
    private $area;

    /**
     * ShootResult constructor.
     * @param Area $area
     */
    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    /**
     * @return bool
     */
    public function isMiss(): bool
    {
        return $this->area->getType() === AreaType::MISS;
    }

    /**
     * @return bool
     */
    public function isHit(): bool
    {
        return $this->area->getType() === AreaType::HIT;
    }

    /**
     * @return bool
     */
    public function isSink(): bool
    {
        return $this->area->getType() === AreaType::SINK;
    }

    /**
     * @return Area
     */
    public function getArea(): AreaInterface
    {
        return $this->area;
    }
}
