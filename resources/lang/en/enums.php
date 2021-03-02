<?php

return [
    \App\Enums\OrderStatus::class => [
        \App\Enums\OrderStatus::PENDING => 'Pending',
        \App\Enums\OrderStatus::PROCESSING => 'Processing',
        \App\Enums\OrderStatus::COMPLETED => 'Completed',
        \App\Enums\OrderStatus::CANCELED => 'Canceled',
    ],
    \App\Enums\ChargeType::class => [
        \App\Enums\ChargeType::FEE => 'Fee',
        \App\Enums\ChargeType::TAX => 'Tax',
        \App\Enums\ChargeType::OTHER => 'Other',
    ],
];
