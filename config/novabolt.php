<?php

return [
    'admin_prefix' => env('ADMIN_PREFIX', 'admin'),
    'admin_emails' => explode(',', env('ADMIN_EMAILS')),
    'app_currency' => env('APP_CURRENCY', 'VND'),
    'currency' => [
        'base' => 'VND',
        'rates' => [
            'VND' => 1,
            'CNY' => 3700,
            'USD' => 24000,
        ],
    ],
];
