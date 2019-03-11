<?php declare(strict_types=1);

namespace App\Component\Dto;

use App\Constants\AreaType;
use App\Entity\Area;

class ShootResult
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
    public function getArea(): Area
    {
        return $this->area;
    }
}
