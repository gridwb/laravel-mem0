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
use Symfony\Component\HttpFoundation\Request;

readonly class Memories implements MemoriesContract
{
    public function __construct(
        private ApiClientContract $apiClient,
    ) {}

    public function addAsync(array $parameters): AddAsyncResponse
    {
        $parameters['async_mode'] = true;

        $response = $this->add($parameters);

        return AddAsyncResponse::fromResponse($response);
    }

    public function addSync(array $parameters): AddSyncResponse
    {
        $parameters['async_mode'] = false;

        $response = $this->add($parameters);

        return AddSyncResponse::fromResponse($response);
    }

    public function search(array $parameters): SearchResponse
    {
        $response = $this->apiClient->request(
            Request::METHOD_POST,
            'v2/memories/search/',
            [
                RequestOptions::JSON => $parameters,
            ]
        );

        return SearchResponse::fromResponse($response);
    }

    /**
     * @param  array<string, mixed>  $parameters
     *
     * @throws GuzzleException
     */
    private function add(array $parameters): ResponseInterface
    {
        $parameters['output_format'] = 'v1.1';

        return $this->apiClient->request(
            Request::METHOD_POST,
            'v1/memories/',
            [
                RequestOptions::JSON => $parameters,
            ]
        );
    }
}
