<?php declare(strict_types=1);

namespace App\Component\Ship;

use App\Component\Desk\Interfaces\DeskInterface;
use App\Component\Ship\Constants\ShipType;
use App\Component\Ship\Interfaces\ShipBuilderInterface;
use App\Component\Ship\Interfaces\ShipFactoryInterface;
use App\Component\Ship\Interfaces\ShipInterface;

class ShipFactory implements ShipFactoryInterface
{
    /**
     * @var ShipBuilderInterface[]|[]
     */
    private $builders;

    /**
     * ShipFactory constructor.
     * @param iterable $builders
     */
    public function __construct(\iterable $builders)
    {
        foreach ($builders as $builder) {
            if ($builder instanceof ShipBuilderInterface) {
                continue;
            }

            throw new \RuntimeException('Ship builder must be instance of ShipBuilderInterface');
        }

        $this->builders = $builders;
    }

    /**
     * @see ShipType
     * @param \App\Component\Desk\Interfaces\DeskInterface $desk
     * @param int $shipType A constant of {@see ShipType}
     * @return ShipInterface
     */
    public function build(DeskInterface $desk, int $shipType): ShipInterface
    {
        foreach ($this->builders as $builder) {
            if ($builder->canBuild($shipType)) {
                return $builder->build($desk);
            }
        }

        throw new \LogicException('Any ship builders not been found for $shipType: ' . $shipType);
    }
}
