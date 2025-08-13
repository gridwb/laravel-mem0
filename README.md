## Overview
Laravel Mem0 is a convenient wrapper for interacting with the Mem0 API in Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require gridwb/laravel-mem0
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-mem0-config"
```
Next, make sure to add the required environment variables to your .env file:
```bash
MEM0_API_URL=https://api.mem0.ai
MEM0_API_KEY=your-api-key-here
```

## Usage

```php
use Gridwb\LaravelMem0\Facades\Mem0;

$memories = [
    [
        'role' => 'user',
        'content' => '<user-message>'
    ],
    [
        'role' => 'assistant',
        'content' => '<assistant-message>'
    ]
];

$result = Mem0::memories()->addAsync($memories);
$result = Mem0::memories()->addSync($memories);

$query = 'What do you know about me?';
$filters = [
    'OR' => [
        [
            'user_id' => 'alex'
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

$result = Mem0::memories()->search($query, $filters);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
