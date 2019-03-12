<?php declare(strict_types=1);

namespace App\Constants;

/**
 * Class AreaType
 *
 * @package App\Constants
 */
class AreaType
{
    /**
     * Default type
     */
    public const SEA = 0;

    /**
     * Missed area
     */
    public const MISS = 1;

    /**
     * Near of a ship
     */
    public const MARGIN = 10;

    /**
     * Part of an intact ship
     */
    public const INTACT = 20;

    /**
     * Part of a hit ship
     */
    public const HIT = 30;

    /**
     * Part of a sink ship
     */
    public const SINK = 40;
}
