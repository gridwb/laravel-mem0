<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Gridwb\LaravelMem0\Responses\AbstractResponse;
use GuzzleHttp\Utils;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;

class SearchResponse extends AbstractResponse
{
    /**
     * @param  Collection<int, SearchResponseMemory>  $memories
     */
    public function __construct(
        #[MapInputName('memories')]
        #[MapOutputName('memories')]
        #[DataCollectionOf(SearchResponseMemory::class)]
        public Collection $memories,
    ) {}

    public static function fromResponse(ResponseInterface $response): static
    {
        return static::from([
            'memories' => Utils::jsonDecode($response->getBody()->getContents(), true),
        ]);
    }
}
