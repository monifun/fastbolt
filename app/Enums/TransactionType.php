<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class TransactionType extends Enum implements LocalizedEnum
{
    const DEPOSIT = 'deposit';
    const WITHDRAW = 'withdraw';
    const PAYMENT = 'payment';
    const REFUND = 'refund';

    public function toArray()
    {
        return $this;
    }
}
