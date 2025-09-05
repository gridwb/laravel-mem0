## Overview

Laravel Mem0 is a convenient wrapper for interacting with the Mem0 API in Laravel applications.

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
    ```bash
    MEM0_API_URL=https://api.mem0.ai
    MEM0_API_KEY=your-api-key-here
    ```

## Usage

```php
use Gridwb\LaravelMem0\Facades\Mem0;

$data = [
    'user_id'  => 'alex',
    'messages' => [
        [
            'role'    => 'user',
            'content' => '<user-message>'
        ],
        [
            'role'    => 'assistant',
            'content' => '<assistant-message>'
        ]
    ]
];

$result = Mem0::memories()->addAsync($data);
$result = Mem0::memories()->addSync($data);

$result = Mem0::memories()->search([
    'query'   => 'What do you know about me?',
    'filters' => [
        'OR' => [
            [
                'user_id' => 'alex',
            ],
            [
                'agent_id' => [
                    'in' => [
                        'travel-assistant',
                        'customer-support'
                    ]
                ]
            ]
        ]
    ]
]);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
