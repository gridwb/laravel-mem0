<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Contracts\Resources;

use Gridwb\LaravelMem0\Responses\Memories\AddAsyncResponse;
use Gridwb\LaravelMem0\Responses\Memories\AddSyncResponse;
use Gridwb\LaravelMem0\Responses\Memories\SearchResponse;
use GuzzleHttp\Exception\GuzzleException;

interface MemoriesContract
{
    /**
     * @param  array<string, mixed>  $parameters
     *
     * @throws GuzzleException
     *
     * @see https://docs.mem0.ai/api-reference/memory/add-memories
     */
    public function addAsync(array $parameters): AddAsyncResponse;

    /**
     * @param  array<string, mixed>  $parameters
     *
     * @throws GuzzleException
     *
     * @see https://docs.mem0.ai/api-reference/memory/add-memories
     */
    public function addSync(array $parameters): AddSyncResponse;

    /**
     * @param  array<string, mixed>  $parameters
     *
     * @throws GuzzleException
     *
     * @see https://docs.mem0.ai/api-reference/memory/v2-search-memories
     */
    public function search(array $parameters): SearchResponse;
}
