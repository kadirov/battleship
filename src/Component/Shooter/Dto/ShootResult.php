<?php declare(strict_types=1);

namespace App\Component\Shooter\Dto;

use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Shooter\Dto\Interfaces\ShootResultInterface;

/**
 * Class ShootResult
 * @package App\Component\Shooter\Dto
 */
class ShootResult implements ShootResultInterface
{
    /**
     * @var AreaInterface
     */
    private $area;

    /**
     * ShootResult constructor.
     * @param AreaInterface $area
     */
    public function __construct(AreaInterface $area)
    {
        $this->area = $area;
    }

    /**
     * @return AreaInterface
     */
    public function getArea(): AreaInterface
    {
        return $this->area;
    }
}
