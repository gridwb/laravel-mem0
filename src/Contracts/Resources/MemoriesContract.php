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
     * @param  string[]  $messages
     * @param  string[]|null  $metadata
     * @param  string[]|null  $customCategories
     *
     * @throws GuzzleException
     */
    public function addAsync(
        array $messages,
        ?string $agentId = null,
        ?string $userId = null,
        ?string $appId = null,
        ?string $runId = null,
        ?array $metadata = null,
        ?string $includes = null,
        ?string $excludes = null,
        bool $infer = true,
        ?array $customCategories = null,
        ?string $customInstructions = null,
        bool $immutable = false,
        bool $asyncMode = false,
        ?int $timestamp = null,
        ?string $expirationDate = null,
        ?string $orgId = null,
        ?string $projectId = null,
        ?string $version = 'v2'
    ): AddAsyncResponse;

    /**
     * @param  string[]  $messages
     * @param  string[]|null  $metadata
     * @param  string[]|null  $customCategories
     *
     * @throws GuzzleException
     */
    public function addSync(
        array $messages,
        ?string $agentId = null,
        ?string $userId = null,
        ?string $appId = null,
        ?string $runId = null,
        ?array $metadata = null,
        ?string $includes = null,
        ?string $excludes = null,
        bool $infer = true,
        ?array $customCategories = null,
        ?string $customInstructions = null,
        bool $immutable = false,
        bool $asyncMode = false,
        ?int $timestamp = null,
        ?string $expirationDate = null,
        ?string $orgId = null,
        ?string $projectId = null,
        ?string $version = 'v2'
    ): AddSyncResponse;

    /**
     * @param  array<string, array<string, string|array<string, string[]>>>  $filters
     * @param  string[]  $fields
     *
     * @throws GuzzleException
     */
    public function search(
        string $query,
        array $filters,
        int $topK = 10,
        array $fields = [],
        bool $reRank = false,
        bool $keywordSearch = false,
        bool $filterMemories = false,
        float $threshold = 0.3,
        ?string $orgId = null,
        ?string $projectId = null
    ): SearchResponse;
}
