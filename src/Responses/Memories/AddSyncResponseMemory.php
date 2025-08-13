<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Gridwb\LaravelMem0\Enums\Memories\Event;
use Spatie\LaravelData\Data;

class AddSyncResponseMemory extends Data
{
    public function __construct(
        public string $id,
        public string $memory,
        public Event $event,
    ) {}
}
