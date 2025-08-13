<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;

class AddAsyncResponse extends AddResponse
{
    /**
     * @param  Collection<int, AddAsyncResponseMemory>  $memories
     */
    public function __construct(
        #[MapInputName('memories')]
        #[MapOutputName('memories')]
        #[DataCollectionOf(AddAsyncResponseMemory::class)]
        public Collection $memories,
    ) {}
}
