## Overview

Laravel Mem0 is a convenient wrapper for interacting with the Mem0 API in Laravel applications.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Memories Resource](#memories-resource)
- [Testing](#testing)
- [Changelog](#changelog)
- [License](#license)

## Installation

1. Install the package
    ```bash
    composer require gridwb/laravel-mem0
    ```

2. Publish the configuration file
    ```bash
    php artisan vendor:publish --tag="mem0-config"
    ```

3. Add environment variables
    ```env
    MEM0_API_URL=https://api.mem0.ai
    MEM0_API_KEY=your-api-key-here
    ```

## Usage

### `Memories` Resource

#### `add sync`

Add memories via a synchronous request:

```php
<?php

use Gridwb\LaravelMem0\Facades\Mem0;

$response = Mem0::memories()->addSync([
    'user_id' => 'alex',
    'messages' => [
        [
            'role' => 'user',
            'content' => '<user-message>',
        ],
        [
            'role' => 'assistant',
            'content' => '<assistant-message>',
        ],
    ],
]);

foreach ($response->memories as $memory) {
    echo $memory->id;
    echo $memory->memory;
    echo $memory->event->value;
}
```

#### `add async`

Add memories via an asynchronous request:

```php
<?php

use Gridwb\LaravelMem0\Facades\Mem0;

$response = Mem0::memories()->addAsync([
    'user_id' => 'alex',
    'messages' => [
        [
            'role' => 'user',
            'content' => '<user-message>',
        ],
        [
            'role' => 'assistant',
            'content' => '<assistant-message>',
        ],
    ],
]);

foreach ($response->memories as $memory) {
    echo $memory->message;
    echo $memory->status->value;
    echo $memory->eventId;
}
```

#### `search`

Search memories request:

```php
<?php

use Gridwb\LaravelMem0\Facades\Mem0;

$response = Mem0::memories()->search([
    'query' => 'What do you know about me?',
    'filters' => [
        'OR' => [
            [
                'user_id' => 'alex',
            ],
            [
                'agent_id' => [
                    'in' => [
                        'travel-assistant',
                        'customer-support',
                    ],
                ],
            ],
        ],
    ],
]);

foreach ($response->memories as $memory) {
    echo $memory->id;
    echo $memory->memory;
    echo $memory->userId;
    // ...
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
