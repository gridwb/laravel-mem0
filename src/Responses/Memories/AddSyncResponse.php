<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;

class AddSyncResponse extends AddResponse
{
    /**
     * @param  Collection<int, AddSyncResponseMemory>  $memories
     */
    public function __construct(
        #[MapInputName('memories')]
        #[MapOutputName('memories')]
        #[DataCollectionOf(AddSyncResponseMemory::class)]
        public Collection $memories,
    ) {}
}
