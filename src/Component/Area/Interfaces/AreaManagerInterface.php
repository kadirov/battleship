<?php declare(strict_types=1);

namespace App\Component\Area\Interfaces;

use App\Entity\Area;

interface AreaManagerInterface
{
    public function save(Area $area): void;
}
