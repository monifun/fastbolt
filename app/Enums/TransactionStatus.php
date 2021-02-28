<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionStatus extends Enum
{
    const PENDING = 'pending';
    const CANCELED = 'canceled';
    const COMPLETED = 'completed';

    public function toArray()
    {
        return $this;
    }
}
