<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Gridwb\LaravelMem0\Enums\Memories\Status;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class AddAsyncResponseMemory extends Data
{
    public function __construct(
        public string $message,
        public Status $status,
        #[MapInputName('event_id')]
        #[MapOutputName('event_id')]
        public string $eventId,
    ) {}
}
