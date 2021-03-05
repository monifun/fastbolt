<?php

return [
    \App\Enums\OrderStatus::class => [
        \App\Enums\OrderStatus::PENDING => 'Chờ xử lý',
        \App\Enums\OrderStatus::PROCESSING => 'Đang xử lý',
        \App\Enums\OrderStatus::COMPLETED => 'Hoàn thành',
        \App\Enums\OrderStatus::CANCELED => 'Đã hủy'
    ],
    \App\Enums\ChargeType::class => [
        \App\Enums\ChargeType::FEE => 'Phí',
        \App\Enums\ChargeType::TAX => 'Thuế',
        \App\Enums\ChargeType::OTHER => 'Khác'
    ],
    \App\Enums\ShipmentStatus::class => [
        \App\Enums\ShipmentStatus::PENDING => 'Chờ xử lý',
        \App\Enums\ShipmentStatus::PICKUP => 'Pick up',
        \App\Enums\ShipmentStatus::TRANSIT => 'Đang vận chuyển',
        \App\Enums\ShipmentStatus::DELIVERED => 'Phát thành công',
        \App\Enums\ShipmentStatus::UNDELIVERED => 'Phát thất bại',
    ],
];
