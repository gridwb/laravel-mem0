<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Contracts;

use Gridwb\LaravelMem0\Contracts\Resources\MemoriesContract;

interface ClientContract
{
    public function memories(): MemoriesContract;
}
