<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0;

use Gridwb\LaravelMem0\Contracts\ApiClientContract;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class ApiClient implements ApiClientContract
{
    private ?Client $client = null;

    public function __construct(
        private readonly string $apiUrl,
        private readonly string $apiKey,
    ) {}

    public function request(string $method, string $path, array $options = []): ResponseInterface
    {
        return $this->getClient()->request($method, $path, $options);
    }

    private function getClient(): Client
    {
        if (is_null($this->client)) {
            $this->client = $this->createClient();
        }

        return $this->client;
    }

    private function createClient(): Client
    {
        return new Client([
            'base_uri' => $this->apiUrl,
            RequestOptions::HEADERS => [
                'Authorization' => "Token $this->apiKey",
                'Content-type' => 'application/json',
            ],
        ]);
    }
}
