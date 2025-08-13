<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0\Responses\Memories;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SearchResponseMemory extends Data
{
    /**
     * @param  array<string, mixed>|null|Optional  $metadata
     * @param  array<string>|Optional  $categories
     */
    public function __construct(
        public string|Optional $id,
        public string|Optional $memory,
        #[MapInputName('user_id')]
        #[MapOutputName('user_id')]
        public string|Optional $userId,
        #[MapInputName('created_at')]
        #[MapOutputName('created_at')]
        public string|Optional $createdAt,
        #[MapInputName('updated_at')]
        #[MapOutputName('updated_at')]
        public string|Optional $updatedAt,
        public array|null|Optional $metadata,
        public array|Optional $categories,
        #[MapInputName('expiration_date')]
        #[MapOutputName('expiration_date')]
        public string|null|Optional $expirationDate,
        public bool|Optional $immutable
    ) {}
}
