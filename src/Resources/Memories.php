<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Resources;

use Gridwb\LaravelMem0\Contracts\ApiClientContract;
use Gridwb\LaravelMem0\Contracts\Resources\MemoriesContract;
use Gridwb\LaravelMem0\Responses\Memories\AddAsyncResponse;
use Gridwb\LaravelMem0\Responses\Memories\AddSyncResponse;
use Gridwb\LaravelMem0\Responses\Memories\SearchResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;

readonly class Memories implements MemoriesContract
{
    public function __construct(
        private ApiClientContract $apiClient,
    ) {}

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
    ): AddAsyncResponse {
        $response = $this->add(
            messages: $messages,
            agentId: $agentId,
            userId: $userId,
            appId: $appId,
            runId: $runId,
            metadata: $metadata,
            includes: $includes,
            excludes: $excludes,
            infer: $infer,
            customCategories: $customCategories,
            customInstructions: $customInstructions,
            immutable: $immutable,
            asyncMode: true,
            timestamp: $timestamp,
            expirationDate: $expirationDate,
            orgId: $orgId,
            projectId: $projectId,
            version: $version
        );

        return AddAsyncResponse::fromResponse($response);
    }

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
    ): AddSyncResponse {
        $response = $this->add(
            messages: $messages,
            agentId: $agentId,
            userId: $userId,
            appId: $appId,
            runId: $runId,
            metadata: $metadata,
            includes: $includes,
            excludes: $excludes,
            infer: $infer,
            customCategories: $customCategories,
            customInstructions: $customInstructions,
            immutable: $immutable,
            asyncMode: false,
            timestamp: $timestamp,
            expirationDate: $expirationDate,
            orgId: $orgId,
            projectId: $projectId,
            version: $version
        );

        return AddSyncResponse::fromResponse($response);
    }

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
    ): SearchResponse {
        $data = array_filter([
            'query' => $query,
            'filters' => $filters,
            'top_k' => $topK,
            'fields' => $fields,
            'rerank' => $reRank,
            'keyword_search' => $keywordSearch,
            'filter_memories' => $filterMemories,
            'threshold' => $threshold,
            'org_id' => $orgId,
            'project_id' => $projectId,
        ], static fn ($value) => ! is_null($value));

        $response = $this->apiClient->request(
            Request::METHOD_POST,
            'v2/memories/search/',
            [
                RequestOptions::JSON => $data,
            ]
        );

        return SearchResponse::fromResponse($response);
    }

    /**
     * @param  string[]  $messages
     * @param  string[]|null  $metadata
     * @param  string[]|null  $customCategories
     *
     * @throws GuzzleException
     */
    private function add(
        array $messages,
        ?string $agentId,
        ?string $userId,
        ?string $appId,
        ?string $runId,
        ?array $metadata,
        ?string $includes,
        ?string $excludes,
        bool $infer,
        ?array $customCategories,
        ?string $customInstructions,
        bool $immutable,
        bool $asyncMode,
        ?int $timestamp,
        ?string $expirationDate,
        ?string $orgId,
        ?string $projectId,
        ?string $version
    ): ResponseInterface {
        if (is_null($agentId) && is_null($userId) && is_null($appId) && is_null($runId)) {
            throw new RuntimeException('At least one of the filters: agent_id, user_id, app_id, run_id is required!');
        }

        $data = array_filter([
            'messages' => $messages,
            'agent_id' => $agentId,
            'user_id' => $userId,
            'app_id' => $appId,
            'run_id' => $runId,
            'metadata' => ! empty($metadata) ? $metadata : null,
            'includes' => ! empty($includes) ? $includes : null,
            'excludes' => ! empty($excludes) ? $excludes : null,
            'infer' => $infer,
            'output_format' => 'v1.1',
            'custom_categories' => ! empty($customCategories) ? $customCategories : null,
            'custom_instructions' => ! empty($customInstructions) ? $customInstructions : null,
            'immutable' => $immutable,
            'async_mode' => $asyncMode,
            'timestamp' => $timestamp,
            'expiration_date' => $expirationDate,
            'org_id' => $orgId,
            'project_id' => $projectId,
            'version' => $version,
        ], static fn ($value) => ! is_null($value));

        return $this->apiClient->request(
            Request::METHOD_POST,
            'v1/memories/',
            [
                RequestOptions::JSON => $data,
            ]
        );
    }
}
