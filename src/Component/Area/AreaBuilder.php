<?php declare(strict_types=1);

namespace App\Component\Area;

use App\Component\Area\Constants\AreaType;
use App\Component\Area\Interfaces\AreaBuilderInterface;
use App\Component\Area\Interfaces\AreaInterface;
use App\Component\Area\Interfaces\AreaManagerInterface;
use App\Component\Desk\Interfaces\DeskInterface;
use App\Entity\Area;

/**
 * Class AreaBuilder
 * @package App\Component\Area
 */
class AreaBuilder implements AreaBuilderInterface
{
    /**
     * @var AreaManagerInterface
     */
    private $areaManager;

    /**
     * AreaBuilder constructor.
     * @param AreaManagerInterface $areaManager
     */
    public function __construct
    (
        AreaManagerInterface $areaManager
    ) {
        $this->areaManager = $areaManager;
    }

    /**
     * @see AreaType
     * @param \App\Component\Desk\Interfaces\DeskInterface $desk
     * @param int $type A constant of {@see AreaType}
     * @param int $coordinateX
     * @param int $coordinateY
     * @return \App\Component\Area\Interfaces\AreaInterface
     * @todo separate builders by type and create factory
     * @throws Exceptions\AreaException
     */
    public function build(DeskInterface $desk, int $type, int $coordinateX, int $coordinateY): AreaInterface
    {
        $area = new Area();
        $area->setType($type);
        $desk->addArea($area);
        $area->setCoordinateX($coordinateX);
        $area->setCoordinateY($coordinateY);
        $this->areaManager->save($area);

        return $area;
    }
}
