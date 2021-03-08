<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ShipmentStatus extends Enum implements LocalizedEnum
{
    const PENDING = 'pending';
    const PICKUP = 'pickup';
    const TRANSIT = 'transit';
    const DELIVERED = 'delivered';
    const UNDELIVERED = 'undelivered';

    public function toArray()
    {
        return $this;
    }
}
