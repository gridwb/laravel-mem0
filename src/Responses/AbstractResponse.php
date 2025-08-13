<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses;

use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;
use Spatie\LaravelData\Data;

abstract class AbstractResponse extends Data
{
    public static function fromResponse(ResponseInterface $response): static
    {
        return static::from(Utils::jsonDecode($response->getBody()->getContents(), true));
    }
}
