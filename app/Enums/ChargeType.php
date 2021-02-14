<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ChargeType extends Enum implements LocalizedEnum
{
    const FEE = 'fee';
    const TAX = 'tax';
    const OTHER = 'other';

    public function toArray()
    {
        return $this;
    }
}
