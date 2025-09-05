<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Resources\Concerns;

use InvalidArgumentException;

trait Asyncable
{
    /**
     * @param  array<string, mixed>  $parameters
     *
     * @throws InvalidArgumentException
     */
    private function ensureNotAsync(array $parameters): void
    {
        if (($parameters['async_mode'] ?? false) === true) {
            throw new InvalidArgumentException('Async option is not supported.');
        }
    }

    /**
     * @param  array<string, mixed>  $parameters
     * @return array<string, mixed>
     */
    private function setAsyncParameter(array $parameters): array
    {
        $parameters['async_mode'] = true;

        return $parameters;
    }
}
