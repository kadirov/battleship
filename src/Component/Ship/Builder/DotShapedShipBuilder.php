<?php declare(strict_types=1);

namespace App\Component\Ship\Builder;

use App\Component\Desk\Interfaces\DeskManagerInterface;
use App\Component\Ship\Interfaces\ShipBuilderInterface;
use App\Component\Ship\Interfaces\ShipInterface;
use App\Constants\AreaType;
use App\Constants\ShipType;
use App\Interfaces\DeskInterface;

class DotShapedShipBuilder implements ShipBuilderInterface
{
    /**
     * @var DeskManagerInterface
     */
    private $deskManager;

    /**
     * DotShapedShipBuilder constructor.
     * @param DeskManagerInterface $deskManager
     */
    public function __construct
    (
        DeskManagerInterface $deskManager
    )
    {
        $this->deskManager = $deskManager;
    }

    /**
     * @param DeskInterface $desk
     * @return ShipInterface
     * @throws \Exception
     */
    public function build(DeskInterface $desk): ShipInterface
    {
        do {
            $coordinateX = $this->generateCoordinate();
            $coordinateY = $this->generateCoordinate();

            $area = $this->deskManager->getAreaByCoordinates($desk, $coordinateX, $coordinateY);
        } while ($area->getType() === AreaType::SEA);

    }

    /**
     * @see ShipType
     * @param int $shipType A constant of {@see ShipType}
     * @return bool
     */
    public function canBuild(int $shipType): bool
    {
        return $shipType === ShipType::DOT_SHAPED;
    }

    /**
     * @return int
     * @throws \Exception
     */
    private function generateCoordinate(): int
    {
        \random_int(1, 10);
    }
}
