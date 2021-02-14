<?php

return [
    \App\Enums\OrderStatus::class => [
        \App\Enums\OrderStatus::PENDING => 'Pending',
        \App\Enums\OrderStatus::PROCESSING => 'Processing',
        \App\Enums\OrderStatus::COMPLETED => 'Completed',
        \App\Enums\OrderStatus::CANCELED => 'Canceled'
    ]
];
