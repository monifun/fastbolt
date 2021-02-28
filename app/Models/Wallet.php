<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Wallet extends Model
{
    use HasFactory;

    protected $casts = [
        'balance' => 'float'
    ];

    public function ownable(): MorphTo
    {
        return $this->morphTo();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function validateBalance(bool $save = false): float
    {
        $credits = $this->transactions()
            ->where('type', TransactionType::DEPOSIT)
            ->sum('amount');

        $debits = $this->transactions()
            ->where('type', TransactionType::WITHDRAW)
            ->sum('amount');

        $payments = $this->transactions()
            ->where('type', TransactionType::PAYMENT)
            ->sum('amount');

        $balance = $credits - ($debits + $payments);

        if ($save) {
            $this->balance = $balance;
            $this->save();
        }

        return $balance;
    }
}
