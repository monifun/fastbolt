<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Chargeable extends MorphPivot
{
    use HasFactory;

    protected $casts = [
        'value' => 'float'
    ];
}
