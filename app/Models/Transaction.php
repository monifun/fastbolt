<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'type',
        'status',
        'amount',
        'meta',
        'note'
    ];

    protected $casts = [
        'type' => TransactionType::class,
        'amount' => 'float'
    ];

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }
}
