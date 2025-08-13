<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Facades;

use Gridwb\LaravelMem0\Contracts\Resources\MemoriesContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static MemoriesContract memories()
 */
final class Mem0 extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mem0';
    }
}
