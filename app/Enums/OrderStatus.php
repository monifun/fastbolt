<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class OrderStatus extends Enum implements LocalizedEnum
{
    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';

    public function toArray()
    {
        return $this;
    }
}
