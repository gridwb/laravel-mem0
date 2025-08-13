<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Gridwb\LaravelMem0\Responses\AbstractResponse;
use GuzzleHttp\Utils;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

class AddResponse extends AbstractResponse
{
    public static function fromResponse(ResponseInterface $response): static
    {
        $data = Utils::jsonDecode($response->getBody()->getContents(), true);

        if (! is_array($data)) {
            $data = [];
        }

        return static::from([
            'memories' => Arr::get($data, 'results', []),
        ]);
    }
}
