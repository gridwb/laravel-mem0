<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Enums\Memories;

enum Event: string
{
    case ADD = 'ADD';
    case UPDATE = 'UPDATE';
    case DELETE = 'DELETE';
}
