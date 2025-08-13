<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0;

use Gridwb\LaravelMem0\Contracts\ApiClientContract;
use Gridwb\LaravelMem0\Contracts\ClientContract;
use Gridwb\LaravelMem0\Resources\Memories;

readonly class Client implements ClientContract
{
    public function __construct(
        private ApiClientContract $apiClient,
    ) {}

    public function memories(): Memories
    {
        return new Memories($this->apiClient);
    }
}
