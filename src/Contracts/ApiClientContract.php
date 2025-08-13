<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

interface ApiClientContract
{
    /**
     * @param  array<string, mixed>  $options
     *
     * @throws GuzzleException
     */
    public function request(string $method, string $path, array $options = []): ResponseInterface;
}
